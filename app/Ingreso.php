<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table = 'ingreso'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha',
        'impuesto',
        'estado',
        'idProveedor'
    ];
}
