<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Articulotalla;
use App\Articulo;
use App\Talla;
use Illuminate\Support\Facades\DB;


class ArticulotallaController extends Controller
{
    //
    public function index(Request $request){

    	if ($request->get('search')!="") {
    		$busqueda=$request->get('search');
    		$articulos=Articulo::join('articulotalla','articulotalla.id_articulo','=','articulo.id')
        ->join('talla','talla.id','=','articulotalla.id_talla')
        ->select('articulo.*','articulotalla.sku as cod_identificacion','talla.talla','articulotalla.id_talla',DB::raw('sum(articulotalla.stock) as stock'))->orderBy('nombre')
            ->groupBy('articulotalla.id_articulo','articulotalla.id_talla')
            ->where('articulotalla.sku',"LIKE","%$busqueda%")
            ->paginate(45);

    	}else{

    	$articulos=Articulo::join('articulotalla','articulotalla.id_articulo','=','articulo.id')
        ->join('talla','talla.id','=','articulotalla.id_talla')
        ->select('articulo.*','articulotalla.sku as cod_identificacion','talla.talla','articulotalla.id_talla',DB::raw('sum(articulotalla.stock) as stock'))->orderBy('nombre')
            ->groupBy('articulotalla.id_articulo','articulotalla.id_talla')
            ->paginate(10);


    	}


            return view('admin.articulos.existencias.index',compact('articulos'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $articulo=Articulo::join('articulotalla','articulotalla.id_articulo','=','articulo.id')
        ->join('talla','talla.id','=','articulotalla.id_talla')
        ->select('articulo.*','articulotalla.id as id_art','articulotalla.sku as cod_identificacion','articulotalla.stock','talla.talla','articulotalla.id_talla')
            ->orderBy('nombre')
            ->where('articulotalla.sku','=',$id)
            ->first();
          //  dd($articulo);
          return view('admin.articulos.existencias.edit',compact('articulo'));

    }
     public function update(Request $request,$id)
    {
        //

        //validamos los datos
        $this->validate($request, ['stock'=>'required']);

        $articulotalla=Articulotalla::find($id);
        $articulotalla->stock=$request->get('stock');
        $update=$articulotalla->save();

        $message= $update ? 'Se ha actualizado el stock correctamente':'Error al actualizar ';
        return redirect()->route('articulotalla.index')->with('message',$message);            

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
        $tallasarticulo=Articulotalla::where('sku',$id);
        $tallasarticulo->delete();
        //$tallasarticulo=Articulotalla::find($id);
       // $tallasarticulo->delete();


        $message= $tallasarticulo ? 'Se elimino la variante del Articulo':'Error al Eliminar la variante ';
       
        return redirect()->route('articulotalla.index')->with('message',$message);
    }


    public function Existencias()
    {
        Excel::create('Existencias Articulos', function($excel) {
            $excel->sheet('Articulos', function($sheet) {
                
        $articulos=Articulo::join('articulotalla','articulotalla.id_articulo','=','articulo.id')
        ->join('talla','talla.id','=','articulotalla.id_talla')
        ->select('articulo.*','articulotalla.sku as cod_identificacion','talla.talla','articulotalla.id_talla',DB::raw('sum(articulotalla.stock) as stock'))->orderBy('nombre')
            ->groupBy('articulotalla.id_articulo','articulotalla.id_talla')
            ->get();

                $sheet->fromArray($articulos);
            });
        })->export('xls');
    }
}
