<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//libreria empleada para generar sku dianamico
use BinaryCats\Sku\HasSku;


class Articulo extends Model
{
    //
      use HasSku;
     protected $table = 'articulo'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'cod_barras','sku','nombre','extract','descripcion','especificaciones','datos_interes', 'url_imagen','activo','visible', 'precio', 'id_marca','id_categoria'
    ];

     public function marca(){
        //El empleado solo puede desempeñarse en un cargo
        return $this->hasOne('App\Marca','id','id_marca');
      }

       public function categoria(){
        //El empleado solo puede desempeñarse en un cargo
        return $this->hasOne('App\Categoria','id','id_categoria');
      }

       public function ordenItem(){
        //
        return $this->hasOne('App\OrdenItem');
      }
      



      //funcion para filtrado
      public function scopeBuscar($query, $busqueda)
      {
          if ($busqueda != "") {
              $query->where('nombre', "LIKE", "%$busqueda%");    

           }
      }

   
}
