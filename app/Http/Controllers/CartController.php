<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Talla;
Use App\Articulotalla;
class CartController extends Controller
{
	/*Constructor*/
	public function __construct () 
    {
		if (!\Session::has('cart'))\Session::put('cart',array());
	}
    //

    
    //show cart
    public function show (){
    	$cart=\Session::get('cart');
    	$total=$this->subtotal();
       // dd($cart);
    	return view('store.cart',compact('cart','total'));

    }

    //add item
    public function add(Request $request){
        /*id */


        $stock=Articulotalla::where('id_talla',$request->id_talla)->where('id_articulo',$request->id_articulo)->first();
        
        if ($stock->stock <= 1) {

            return redirect()->back()->with('message','Upss lo sentimos al parecer tenemos stock en 0 de la talla que buscas intenta con otra. ):');


        }else{
                //obtenemos la cantidad del pedido
                $pedido=$request->quantityrqst;
                //si el stock es menor al pedido notificamos al usuario
                if ($stock->stock<$pedido) {

                    return redirect()->back()->with('message','Upss tu pedido supera nuestro stock intenta con una cantidad menor a '.$stock->stock);


                }else{

               // dd($stock);
                        //Obtenemos el id de el articulo atra vez de request
                        $id=$request->id_articulo;

                        $talla=Talla::where('id',$request->id_talla)->pluck('talla');

                        //Buscamos el articulo en la BD

                        $articulo=Articulo::find($id);

                        //OBTENEMOS LA SESSION 
                        $cart=\Session::get('cart');

                        //agregamos al articulo la catidad del pedido
                        $articulo->quantity=$request->quantityrqst;
                        $articulo->id_talla=$request->id_talla;
                        $articulo->talla=$talla->last();

                        $cart[$articulo->id]=$articulo;
                        \Session::put('cart',$cart);

                        return redirect()->route('cart-show');
                }


        }
       
    }
    //delete item
    public function delete($id){
    	$cart=\Session::get('cart');
    	//dd($articulo);
    	unset($cart[$id]);
    	//unset($cart['']);
    	 \Session::put('cart',$cart);
    	return redirect()->route('cart-show');

    }
    //update item
    public function update($id,$quantity){

    	 $articulo=Articulo::find($id);
    	$cart=\Session::get('cart');
    	 $cart[$articulo->id]->quantity=$quantity;
    	  \Session::put('cart',$cart);
    	 return redirect()->route('cart-show');


    }
    //TRash cart
    public function trash(){
    	\Session::forget('cart');
    	 return redirect()->route('cart-show');


    }


    //Total
    private function subtotal(){
    	 $cart=\Session::get('cart');
    	 $subtotal=0;
	    	 foreach ($cart as $item) {
	    	 	$subtotal+=$item->precio*$item->quantity;
	    	 }

    	 return $subtotal;
    }


    public function OrderDetail(){
    	if (count(\Session::get('cart'))<=0) return redirect()->route('home');
    	 $cart=\Session::get('cart');
         $envio=100.00;
    	 $subtotal=$this->subtotal()+$envio;
         $taxes = bcdiv(bcmul(16, $subtotal, 2), 100, 2);
         $total = $subtotal + $taxes;



    	return view('store.order-detail',compact('cart','envio','subtotal','taxes','total'));
    }
}
