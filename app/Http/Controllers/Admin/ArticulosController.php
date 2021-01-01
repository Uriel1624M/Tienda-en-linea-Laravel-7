<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Articulo;
use App\Categoria;
use App\Marca;
use App\Talla;
use App\Articulotalla;
use Illuminate\Support\Facades\DB;


class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articulos=Articulo::orderBy('id','desc')->paginate(10);
        
        return view('admin.articulos.index',compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $categorias=Categoria::orderBy('id','desc')->pluck('nombre', 'id');
         $tallas=Talla::orderBy('id','desc')->pluck('talla', 'id');
         $marcas=Marca::orderBy('id','desc')->pluck('marca', 'id');
         //$tallas=Talla::all();


        return view('admin.articulos.create',compact('categorias','marcas','tallas'));

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
         $this->validate($request, ['cod_barras'=>'numeric|unique:articulo|required',
            'nombre'=>'required','extract'=>'required','precio'=>'required',
            'id_categoria'=>'required','id_marca'=>'required','descripcion'=>'required',
            'url_imagen'=>'required',]);

    
        if ($request->hasFile('url_imagen')){

          $file= $request->file('url_imagen');
            $nombrearchivo  = $file->getClientOriginalName();
            $file->move(public_path("storage"),$nombrearchivo);
        }


         $articulo=Articulo::create([
            'cod_barras'=>$request['cod_barras'],
            'nombre'=>$request['nombre'],
            'extract'=>$request['extract'],
            'descripcion'=>$request['descripcion'],
            'especificaciones'=>$request['especificaciones'],
            'datos_interes'=>$request['datos_interes'],
            'activo'=>$request->has('activo')? 1 :0,
            'visible'=>$request->has('sliderprincipal')? 1 :0,
            'url_imagen'=>$nombrearchivo,
            'precio'=>$request['precio'],
            'id_categoria'=>$request['id_categoria'],
            'id_marca'=>$request['id_marca'],
            

         ]);


        $id_articulo= Articulo::all()->sortBy('id', SORT_NATURAL | SORT_FLAG_CASE)->pluck( 'id');



        $idtalla=$request->get('idtalla');
        $cantidad=$request->get('cantidad');
        $contador=0;

        if ($request->get('idtalla')!="") {

            while($contador <count($idtalla))
                {
                    $articulotalla=Articulotalla::create([
                            'id_articulo'=>$id_articulo->last(),
                            'id_talla'=>$idtalla[$contador],
                            'stock'=>$cantidad[$contador],


                         ]);
                     
                      $contador=$contador+1;

                }

        }
            
        return redirect()->route('articulos.index')->with('message','Buen echo');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        //,$id_talla
        $categorias=Categoria::orderBy('id','desc')->pluck('nombre', 'id');

        $marcas=Marca::orderBy('id','desc')->pluck('marca', 'id');
        $articulo=Articulo::find($id);

          return view('admin.articulos.edit',compact('articulo','categorias','marcas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $this->validate($request,
         ['cod_barras'=>'string|required|min:5|max:30',
          'nombre'=>'string|required|min:5|max:45',
          'precio'=>'required|min:1|max:10',
          'descripcion'=>'required|string|min:10|max:800',
          'extract'=>'required|string|min:5|max:150',
          'id_categoria'=>'required',
          'id_marca'=>'required'
           ]);

        $tr=$request->hasfile('imagen');
        $art=Articulo::find($id);

        if(!empty($tr)){
            if (\Storage::exists($art->url_foto)) {
                # si la fotografia existe procedemos a eliminarla
                \Storage::delete($art->url_foto);
            }
            $file= $request->file('imagen');
            $nombrearchivo  = $file->getClientOriginalName();
            $file->move(public_path("storage"),$nombrearchivo);

            $articulo=Articulo::find($id);  
            $articulo->cod_barras=$request->get('cod_barras');
            $articulo->nombre=$request->get('nombre');
            $articulo->extract=$request->get('extract');
            $articulo->especificaciones=$request->get('especificaciones');
            $articulo->datos_interes=$request->get('datos_interes');
            $articulo->precio=$request->get('precio');
            $articulo->activo=$request->has('activo')? 1 :0;
            $articulo->visible=$request->has('sliderprincipal')? 1 :0;
            $articulo->url_imagen=$nombrearchivo;
            $articulo->descripcion=$request->get('descripcion');
            $articulo->id_marca=$request->get('id_marca');
            $articulo->id_categoria=$request->get('id_categoria');
            $update=$articulo->save();


        }else{

            $articulo=Articulo::find($id);  
            $articulo->cod_barras=$request->get('cod_barras');
            $articulo->nombre=$request->get('nombre');
            $articulo->extract=$request->get('extract');
            $articulo->descripcion=$request->get('descripcion');
            $articulo->especificaciones=$request->get('especificaciones');
            $articulo->datos_interes=$request->get('datos_interes');
            $articulo->activo=$request->has('activo')? 1 :0;
            $articulo->precio=$request->get('precio');
            $articulo->visible=$request->has('sliderprincipal')? 1 :0;
            $articulo->id_marca=$request->get('id_marca');
            $articulo->id_categoria=$request->get('id_categoria');
            $update=$articulo->save();

          
        }
            
    

        $message= $update ? 'Articulo Actualizado correctamente':'Error al actulizar ';
        return redirect()->route('articulos.index')->with('message',$message);    

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
        $tallasarticulo=Articulotalla::where('id_articulo',$id);
        $tallasarticulo->delete();

        $articulo=Articulo::find($id);
        $articulo->delete();

        $message= $articulo ? 'Articulo Eliminado correctamente':'Error al Eliminar ';
       
        return redirect()->route('articulos.index')->with('message',$message);
    }
}
