<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $categorias=Categoria::Buscar($request->get('search'))->paginate(5);
        return view('admin.categorias.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categorias.create');
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
        $this->validate($request, ['nombre'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

        $categoria=Categoria::create([
            'nombre'=>$request->get('nombre'),
            'descripcion'=>$request->get('descripcion')

        ]);

        $message=$categoria ? 'Categoria Agregada correctamente':'Error al Agregar '; 

        return redirect()->route('categoria.index')->with('message',$message);

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
        $categoria=Categoria::find($id);
        return view('admin.categorias.edit',compact('categoria'));
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
        $this->validate($request, ['nombre'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

        $categoria=Categoria::find($id);    
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $update=$categoria->save();

        $message= $update ? 'Categoria Actualizada correctamente':'Error al actulizar ';
        return redirect()->route('categoria.index')->with('message',$message);            

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
        $categoria=Categoria::find($id);
        $categoria->delete();

        $message= $categoria ? 'Categoria Eliminada correctamente':'Error al eliminar ';

    return redirect()->route('categoria.index')->with('message',$message);
    }
}
