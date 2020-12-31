<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Marca;
class MarcaController extends Controller
{
    //
    public function index(Request $request){

    	$marcas=Marca::Buscar($request->get('search'))->paginate(5);;
        return view('admin.marcas.index',compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.marcas.create');
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
        $this->validate($request, ['marca'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

        $marca=Marca::create([
            'marca'=>$request->get('marca'),
            'descripcion'=>$request->get('descripcion')

        ]);

        $message=$marca ? 'Marca Agregada correctamente':'Error al Agregar '; 

        return redirect()->route('marcas.index')->with('message',$message);

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
        $marca=Marca::find($id);
        return view('admin.marcas.edit',compact('marca'));
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
        $this->validate($request, ['marca'=>'string|required|min:5|max:20','descripcion'=>'required|string|min:10|max:100']);

        $marca=Marca::find($id);    
        $marca->marca=$request->get('marca');
        $marca->descripcion=$request->get('descripcion');
        $update=$marca->save();

        $message= $update ? 'Marca Actualizada correctamente':'Error al actualizar ';
        return redirect()->route('marcas.index')->with('message',$message);            

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
        $marca=Marca::find($id);
        $marca->delete();

        $message= $marca ? 'Marca Eliminada correctamente':'Error al eliminar ';

    return redirect()->route('marcas.index')->with('message',$message);
    }
}
