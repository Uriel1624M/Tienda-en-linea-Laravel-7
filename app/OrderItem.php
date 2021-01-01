<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $table = 'orderitems'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'precio','quantity','id_talla','articulo_id','order_id'
    ];


    public function order(){
        return $this->belongsTo('App\Order','order_id','id');
    }

    public function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    public function talla(){
        return $this->belongsTo('App\Talla','id_talla','id');
    }
}
