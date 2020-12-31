<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = 'proveedor'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'nombre','email','telefono','direccion'
    ];
}
