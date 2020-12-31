<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    //
    protected $table = 'talla'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'talla','descripcion'
    ];


    //funcion para filtrado
      public function scopeBuscar($query, $busqueda)
      {
          if ($busqueda != "") {
              $query->where('talla', "LIKE", "%$busqueda%");    

           }
      }


    /**
      Funcion usada para obtener que tallas estan registradas a cada articulo pra dar de alta 
      un ingreso 
    **/
    public static function tallasarticulo($id){

    	return Talla::join('articulotalla','articulotalla.id_talla','=','talla.id')
                	->select('articulotalla.id_talla as id','talla.talla as talla')
                	->where('articulotalla.id_articulo',$id)
                	->orderBy('articulotalla.id_talla','desc')
                	->get();
    }

}
