<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
class OrderController extends Controller
{
    //
    public function index(Request $request){

        if ($request->get('fecha_inicio')!="" &&$request->get('fecha_final')!="") {
                
                $orders=Order::orderby('id','desc')
                ->where('fecha','>=',$request->get('fecha_inicio'))
                ->where('fecha','<=',$request->get('fecha_final'))
                ->paginate(500);
        }else{
            $orders=Order::orderby('id','desc')->paginate(10);
        

        }

    	//dd($orders);
    	return view('admin.orders.index',compact('orders'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,$estado)
    {
        //

        //validamos los datos
       // $this->validate($request, ['estado'=>'string|required']);
        $Order=Order::find($id);    
        $Order->estado=$estado;
        $update=$Order->save();

        $message= $update ? 'El estado del pedido fue actualizado correctamente':'Error al actualizar ';
        return redirect()->route('orders.index')->with('message',$message);            

    }



    public function getItems(Request $request){

    	$items=OrderItem::with('articulo')->where('order_id',$request->get('order_id'))->get();
    	return json_encode($items);

    }

    public function destroy($id){

         $order=Order::find($id);
        $order->delete();

        $message= $order ? 'Categoria Eliminada correctamente':'Error al eliminar ';

    return redirect()->route('orders.index')->with('message',$message);

    }
}
