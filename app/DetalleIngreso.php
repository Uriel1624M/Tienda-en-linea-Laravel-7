<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //
    protected $table = 'detalle_ingreso'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'cantidad',
        'precio_compra',
        'precio_venta',
        'idingreso',
        'idarticulo',
        'idtalla'
    ];
}
