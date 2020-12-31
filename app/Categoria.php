<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categoria'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'nombre','descripcion'
    ];




    //funcion para filtrado
      public function scopeBuscar($query, $busqueda)
      {
          if ($busqueda != "") {
              $query->where('nombre', "LIKE", "%$busqueda%");    

           }
      }
}
