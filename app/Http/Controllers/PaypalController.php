<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Order;
use App\OrderItem;
//usado para obtener fecha actual
use Carbon\Carbon;


class PaypalController extends Controller
{
     private $_api_context;

     public $number;

    public function __construct() {
       //  $this->middleware('auth');
        // setup PayPal api context
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function postPayment() {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = array();
        $subtotal = 0;
        $carrito = \Session::get('cart');
        $currency = 'MXN';

        foreach($carrito as $producto){
            $item = new Item();
            $item->setName($producto['nombre'])
            ->setCurrency($currency)
            ->setDescription($producto['extract'])
            ->setQuantity($producto['quantity'])
            ->setPrice($producto['precio']);

            $items[] = $item;
            $subtotal += $producto['quantity'] * $producto['precio'];
        }
        $item = new Item();
        $item->setName('Costo de Envío')
            ->setCurrency($currency)
            ->setDescription('00')
            ->setQuantity(1)
            ->setPrice(100);
        $items[] = $item;
        $subtotal += 100;

        $item_list = new ItemList();
        $item_list->setItems($items);

        $taxes = bcdiv(bcmul(16, $subtotal, 2), 100, 2);
        $details = new Details();
        $details->setSubtotal($subtotal)
        ->setShipping(0)
        ->setTax($taxes);

        $total = $subtotal + $taxes;

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de prueba en mi Laravel App Store');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        \Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);
        }

        return \Redirect::route('cart-show')
            ->with('message', 'Ups! Error desconocido.');
    }


    public function getPaymentStatus(Request $request) {
        // Get the payment ID before session clear
        $payment_id = \Session::get('paypal_payment_id');

        // clear the session payment ID
        \Session::forget('paypal_payment_id');

        $payerId = $request->PayerID;
        $token = $request->token;
//      $payerId = Input::get('PayerID'); 
//      $token = Input::get('token');

        //if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        if (empty($payerId) || empty($token)) {
            return \Redirect::route('home')
                ->with('message', 'Hubo un problema al intentar pagar con Paypal');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            // Registrar el pedido --- ok
            // Registrar el Detalle del pedido  --- ok
            // Eliminar carrito
            // Enviar correo a user
            // Enviar correo a admin
            // Redireccionar
            $this->saveOrder(\Session::get('cart'));
             $carrito = \Session::get('cart');
            \Session::forget('cart');

            $this->printInvoice($carrito);

            return \Redirect::route('home')
                ->with('message', 'Compra realizada de forma correcta');
        }
        return \Redirect::route('inicio')
            ->with('message', 'La compra fue cancelada');
    }


    private function saveOrder($carrito) {
        $fecha=Carbon::now();

        $subtotal = 0;

        foreach($carrito as $item){
            $subtotal += $item->precio * $item->quantity;
        }

        $order = Order::create([
            'fecha'=>$fecha,
            'subtotal' => $subtotal,
            'shipping' => 100,
            'estado'=>'recibido',
            'user_id' => Auth::user()['id']
        ]);

        foreach($carrito as $item){
            $this->saveOrderItem($item, $order->id);
        }
    }

    private function saveOrderItem($item, $order_id) {
       $order= OrderItem::create([
            'quantity' => $item->quantity,
            'precio' => $item->precio,
            'articulo_id' => $item->id,
            'order_id' => $order_id,
            'id_talla'=> $item->id_talla
        ]);

       $this->number=$order->id;

    }


    private function printInvoice($carrito) {
        $invoice = \ConsoleTVs\Invoices\Classes\Invoice::make('Factura');
        foreach($carrito as $producto) {
            $invoice = $invoice->addItem($producto['nombre']." ".$producto['talla'], $producto['precio'], $producto['quantity'], $producto['sku']);
        }

        $destinationPath = '/public/invoices/'."Orden-".$this->number." ".Auth::user()->name." ".Auth::user()->last_name.'.pdf';
        $completePath = $destinationPath;

        $invoice = $invoice->addItem('Costo de envío', 100.00, 1, 00)
            ->number($this->number)
            ->notes('Salida la mercancía no se aceptan devoluciones.')
            ->customer([
                'name' => Auth::user()->name." ".Auth::user()->last_name,
                'id' => Auth::user()->id,
                'location' => Auth::user()->address,
            ])
            //->download(Auth::user()->name." ".Auth::user()->last_name);
            ->save($completePath);
    }

}
