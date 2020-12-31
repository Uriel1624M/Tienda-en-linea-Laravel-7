<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Categoria;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
//libreria
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    //
    public function all(Request $request){
        //$articulos=	Articulo::all();

        $idCategoria = $request->has('categoria') ? $request->categoria : 0;
        if ($idCategoria) {
            $articulos = Articulo::where('id_categoria', $idCategoria)
                ->where('visible',1)
                ->orderBy('nombre', 'desc')
                ->paginate(5);
        }else{
             $articulos= Articulo::Buscar($request->get('busqueda'))
                ->where('visible',1)
                ->orderBy('id', 'desc')->paginate(6);
            //$idCategoria=1;
        }

        return view('store.index',['articulos'=>$articulos,'categorias'=>$categorias=Categoria::all(),'idCategoria'=>$idCategoria]);
    }


    public function show($id){
        //obtenemos las tallas disponibles del articulo
        $detail_articulo=\DB::table('articulo')->
                        join('articulotalla','articulotalla.id_articulo','=','articulo.id')->
                        join('talla','talla.id','=','articulotalla.id_talla')->
                        select('articulotalla.id_talla as id_talla','talla.talla as talla')->
                        where('articulo.id',$id)
                        ->where('articulotalla.stock','>',0)
                        ->pluck('talla','id_talla');
                       // dd($detail_articulo);


    	$articulo=Articulo::where('id',$id)->first();
    	//dd($articulo);
    	return view('store.show',compact('articulo','detail_articulo'));

    }
}
