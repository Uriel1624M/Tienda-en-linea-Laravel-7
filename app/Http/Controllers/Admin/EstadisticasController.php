<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Charts\SampleChart;
use App\User;
Use App\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class EstadisticasController extends Controller
{
    //
    public function index(){

    	$año=Carbon::now()->format('Y-m-d');
    	//total de ventas agrupadas en un mes de acuedo al año corriente
    	$ventas=DB::table('orders as v')
    	->select(DB::raw('SUM(v.subtotal) AS Total'), DB::raw('MONTHNAME(v.fecha) AS Mes'))
    	->whereYear('v.fecha','=',$año)
    	->groupBy('Mes')
    	->orderBy('v.fecha','desc')
    	->get();

    	$total = array();
    	for ($i=0; $i < count($ventas); $i++) { 
    		$total[$i]=$ventas[$i]->Total;
    	}

        $colors = ['red', 'blue', 'green', 'teal', 'yellow', 'orange', 'pink', 'gray', 'indigo', 'purple'];

        $bgColors = array();

        for ($i = 0; $i < count($ventas); $i++) {
            $bgColors[$i] = $colors[array_rand($colors)];
        }

        $Ventaschart = new SampleChart;
        $Ventaschart->labels($ventas->pluck('Mes'));
        $Ventaschart->dataset('Ventas por mes del año '.$año, 'bar',$total)->backgroundColor($bgColors);

        //Total de compras efectuadas clasificadas x mes del año corriente

    	$compras=DB::table('ingreso as ing')
    	->join('detalle_ingreso as det_ingreso','det_ingreso.idingreso','=','ing.id')
    	->select(DB::raw('SUM(det_ingreso.cantidad* det_ingreso.precio_compra) as total'), DB::raw('MONTHNAME(ing.fecha) AS Mes'))
    	->whereYear('ing.fecha','=',$año)
        ->where('estado','=','CONFIRMADO')
    	->groupBy('Mes')
    	->orderBy('ing.fecha','desc')
    	->get();

    	$total = array();
    
    	for ($i=0; $i < count($compras); $i++) { 
    		$total[$i]=$compras[$i]->total;
    	}

        $colors = ['red', 'blue', 'green', 'teal', 'yellow', 'orange', 'pink', 'gray', 'indigo', 'purple'];

        $bgColors = array();

        for ($i = 0; $i < count($compras); $i++) {
            $bgColors[$i] = $colors[array_rand($colors)];
        }

        $Compraschart = new SampleChart;
        $Compraschart->labels($compras->pluck('Mes'));
        $Compraschart->dataset('Compras por mes año '.$año, 'bar',$total)->backgroundColor($bgColors);


        $totalventas=DB::table('orderitems as compra')
        ->join('articulo','articulo.id','=','compra.articulo_id')
        ->join('talla','talla.id','=','compra.id_talla')
        ->select('articulo.id',DB::raw('CONCAT(articulo.nombre," ",talla.talla) as nombre'),DB::raw('SUM(compra.quantity) AS totalventas'))
        ->groupBy('articulo.id','compra.id_talla')
        ->orderBy('articulo.id')
        ->take(20)
        ->get();

        $total = array();
    	$cont=0;
    	foreach ($totalventas as $row) {
    		$total[$cont]=$row->totalventas;

    		$cont=$cont+1;
    	}

        $colors = ['red', 'blue', 'green', 'teal', 'yellow', 'orange', 'pink', 'gray', 'indigo', 'purple'];

        $bgColors = array();

        for ($i = 0; $i < count($totalventas); $i++) {
            $bgColors[$i] = $colors[array_rand($colors)];
        }

        $masvendidochart = new SampleChart;
        $masvendidochart->labels($totalventas->pluck('nombre'));
        $masvendidochart->dataset('LO mas vendido '.$año, 'pie',$total)->backgroundColor($bgColors);



        return view('admin.estadisticas.index',compact('Ventaschart','Compraschart','masvendidochart'));

    }
}
