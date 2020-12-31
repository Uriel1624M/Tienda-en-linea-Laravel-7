<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proveedor;
class ProveedorController extends Controller
{
   
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $proveedores=Proveedor::orderBy('id','desc')->paginate(10);
        
        return view('admin.proveedores.index',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.proveedores.create');
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
        $this->validate($request, ['nombre'=>'string|required|min:5','email'=>'required|email','telefono'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/','direccion'=>'required|string']);

        //regex:/^([0-9\s\-\+\(\)]*)$/ digits:10

        $proveedor=Proveedor::create([
            'nombre'=>$request->get('nombre'),
            'email'=>$request->get('email'),
            'telefono'=>$request->get('telefono'),
            'direccion'=>$request->get('direccion')

        ]);

        $message=$proveedor ? 'Proveedor Agregado correctamente':'Error al Agregar '; 

        return redirect()->route('proveedor.index')->with('message',$message);

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
        $proveedor=Proveedor::find($id);
        return view('admin.proveedores.edit',compact('proveedor'));
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
        $this->validate($request, ['nombre'=>'string|required|min:5','email'=>'required|email','telefono'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/','direccion'=>'required|string']);

        $proveedor=Proveedor::find($id);    
        $proveedor->nombre=$request->get('nombre');
        $proveedor->email=$request->get('email');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->direccion=$request->get('direccion');
        $update=$proveedor->save();

        $message= $update ? 'Ṕroveedor Actualizado correctamente':'Error al actualizar ';
        return redirect()->route('proveedor.index')->with('message',$message);            

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
        $proveedor=Proveedor::find($id);
        $proveedor->delete();

        $message= $proveedor ? 'Proveedor eliminado correctamente':'Error al eliminar ';

    return redirect()->route('proveedor.index')->with('message',$message);
    }

}
