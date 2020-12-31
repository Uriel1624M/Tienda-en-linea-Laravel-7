<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Ingreso;
use App\DetalleIngreso;
use App\Proveedor;
use App\Articulo;
use App\Talla;

use Illuminate\Support\Facades\DB;
//usado para obtener fecha actual
use Carbon\Carbon;



class IngresoController extends Controller
{
    //

    public function index(Request $request){

        if($request->get('search')!=""){

            $ingresos=Ingreso::join('detalle_ingreso as idt','idt.idingreso','=','ingreso.id')
               ->join('proveedor as p','p.id','=','ingreso.idProveedor')
               ->select('ingreso.id','ingreso.fecha','p.nombre','ingreso.tipo_comprobante','ingreso.serie_comprobante','ingreso.num_comprobante','ingreso.impuesto','ingreso.estado',DB::raw('SUM(idt.cantidad* idt.precio_compra) as total'))
                ->groupBy('ingreso.id','ingreso.fecha','p.nombre','ingreso.tipo_comprobante')
                ->orderBy('id','desc')
                ->where('ingreso.serie_comprobante','=',$request->get('search'))
                ->paginate(5);




        }else{

        	$ingresos=Ingreso::join('detalle_ingreso as idt','idt.idingreso','=','ingreso.id')
        	   ->join('proveedor as p','p.id','=','ingreso.idProveedor')
        	   ->select('ingreso.id','ingreso.fecha','p.nombre','ingreso.tipo_comprobante','ingreso.serie_comprobante','ingreso.num_comprobante','ingreso.impuesto','ingreso.estado',DB::raw('SUM(idt.cantidad* idt.precio_compra) as total'))
            	->groupBy('ingreso.id','ingreso.fecha','p.nombre','ingreso.tipo_comprobante')
                ->orderBy('id','desc')
             	->paginate(5);

    }

        return view('admin.compras.ingresos.index',compact('ingresos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $articulos=Articulo::select('id',DB::raw('CONCAT( cod_barras ," ",nombre) as nombre'))
        					->pluck('nombre', 'id');

        $proveedores=Proveedor::orderBy('id','desc')->pluck('nombre', 'id');


        return view('admin.compras.ingresos.create',compact('proveedores','articulos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         //validamos los datos
      //  $this->validate($request, ['marca'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

    		try {
	    			DB::beginTransaction();
	    			
		    			$ingreso= new Ingreso();
		    			$ingreso->idProveedor=$request->get('id_proveedor');
		    			$ingreso->tipo_comprobante=$request->get('tipo_comprobante');
		    			$ingreso->serie_comprobante=$request->get('serie_comprobante');
		    			$ingreso->num_comprobante=$request->get('num_comprobante');
                        $fecha=Carbon::now()->toDateString();
		    			$ingreso->fecha=$fecha;
		    			$ingreso->impuesto='16';
		    			$ingreso->estado='CONFIRMADO';
		    			$ingreso->save();

		    			$idarticulo=$request->get('idarticulo');
					  	$idtalla=$request->get('idtalla');
					    $cantidad=$request->get('cantidad');
					    $preciocompra=$request->get('preciocompra');
					    $precioventa=$request->get('precioventa');

					    $contador=0;
					    while ($contador < count($idarticulo)) {

					    	$detalleIngreso= new DetalleIngreso();
					    	$detalleIngreso->cantidad=$cantidad[$contador];
					    	$detalleIngreso->precio_compra=$preciocompra[$contador];
					    	$detalleIngreso->precio_venta=$precioventa[$contador];
					    	$detalleIngreso->idingreso=$ingreso->id;
					    	$detalleIngreso->idarticulo=$idarticulo[$contador];
					    	$detalleIngreso->idtalla=$idtalla[$contador];

					    	$detalleIngreso->save();

					    	$contador=$contador+1;

					    }


	    			DB::commit();
	    			
    		} catch (Exception $e) {

    			DB::rollback();
    			
    		}


        $message=$ingreso ? 'Registro de compra guardado exitosamente':'!! Disculpa a ocurrido un error vuelve a intentarlo '; 

        return redirect()->route('ingresos.index')->with('message',$message);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    	$ingreso=Ingreso::join('detalle_ingreso as idt','idt.idingreso','=','ingreso.id')
    	->join('proveedor as p','p.id','=','ingreso.idProveedor')
    	->select('ingreso.id','ingreso.fecha','p.nombre','ingreso.tipo_comprobante','ingreso.serie_comprobante','ingreso.num_comprobante','ingreso.impuesto','ingreso.estado',DB::raw('SUM(idt.cantidad* idt.precio_compra) as total'))
    	->groupBy('ingreso.id','ingreso.fecha','p.nombre','ingreso.tipo_comprobante')
    	->where('ingreso.id','=',$id)
    	->first();

    	$detalles=DetalleIngreso::join('articulo as art','art.id','=','detalle_ingreso.idarticulo')
    	->select('art.nombre','detalle_ingreso.idtalla','detalle_ingreso.cantidad','detalle_ingreso.precio_compra','detalle_ingreso.precio_venta')
    	->where('detalle_ingreso.idingreso','=',$id)
    	->get();

        return view('admin.compras.ingresos.show',compact('ingreso','detalles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ingreso=Ingreso::find($id);
        $ingreso->estado="CANCELADO";
        $ingreso->save();

        $message= $ingreso ? 'Ingreso Cancelado correctamente':'Error al Cancelar ';

        return redirect()->route('ingresos.index')->with('message',$message);
    }


    //funcion para realizar la busqueda de las tallas disponibles para la prenda
    public function getSize(Request $request,$id){

    	   $tallas=Talla::tallasarticulo($id);
    		return response()->json($tallas);

    	// if ($request->ajax()) {
    	// 	$tallas=Talla::tallasarticulo($id);
    	// 	return response()->json($tallas);

    	// }


    }

}
