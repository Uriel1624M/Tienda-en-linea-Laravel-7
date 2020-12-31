<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;;

class UserController extends Controller
{
    //
    //
    public function index(){

    	$users=User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
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
        $user=User::find($id);
        return view('admin.users.edit',compact('user'));
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
        $this->validate($request, [
        	'name'=>'string|required|max:100',
        	'last_name'=>'required|string|max:100',
        	'email'=>'required|email',
        	'type'=>'required|in:user,admin',
        	'address'=>'required|string',
        	'password'=>($request->get('password') !="") ? 'required|confirmed' : "",

        ]);

        $user=User::find($id);    
        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');
        $user->email=$request->get('email');
        $user->type=$request->get('type');
        $user->address=$request->get('address');
        $user->active=$request->has('active') ? 1 :0;
        if ($request->get('password')!="") {

      		$user->password=bcrypt($request->get('password'));
            $update=$user->save();
            $message= $update ? 'User Actualizada correctamente':'Error al actualizar ';
            return redirect()->route('users.index')->with('message',$message);            

        }

        $update=$user->save();

        $message= $update ? 'User Actualizada correctamente':'Error al actualizar ';
        return redirect()->route('users.index')->with('message',$message);            

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
        $user=User::find($id);
        $user->delete();

        $message= $user ? 'Usuario Eliminado correctamente':'Error al eliminar ';

    return redirect()->route('users.index')->with('message',$message);
    }
}
