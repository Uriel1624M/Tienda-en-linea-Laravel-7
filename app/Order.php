<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'fecha','subtotal','shipping','estado','user_id'
    ];

   //relacion user pedido 
    public function users(){
        return $this->belongsTo('App\User','user_id','id');
    }


    public function orderitems(){
        return $this->hasMany('App\OrderItem','order_id','id');
    }
}
