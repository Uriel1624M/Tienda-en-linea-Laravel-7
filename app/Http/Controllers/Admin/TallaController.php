<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Talla;
class TallaController extends Controller
{
    //
    public function index(Request $request){

    	$tallas=Talla::Buscar($request->get('search'))->paginate(5);
        return view('admin.tallas.index',compact('tallas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tallas.create');
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
        $this->validate($request, ['talla'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

        $talla=Talla::create([
            'talla'=>$request->get('talla'),
            'descripcion'=>$request->get('descripcion')

        ]);

        $message=$talla ? 'Talla Agregada correctamente':'Error al Agregar '; 

        return redirect()->route('tallas.index')->with('message',$message);

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
        //
        $talla=Talla::find($id);
        return view('admin.tallas.edit',compact('talla'));
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

        //validamos los datos
        $this->validate($request, ['talla'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

        $talla=Talla::find($id);    
        $talla->talla=$request->get('talla');
        $talla->descripcion=$request->get('descripcion');
        $update=$talla->save();

        $message= $update ? 'Talla Actualizada correctamente':'Error al actualizar ';
        return redirect()->route('tallas.index')->with('message',$message);            

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
        $talla=Talla::find($id);
        $talla->delete();

        $message= $talla ? 'Talla Eliminada correctamente':'Error al eliminar ';

    return redirect()->route('tallas.index')->with('message',$message);
    }
}
