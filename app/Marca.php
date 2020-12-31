<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    //use HasFactory;
    protected $table = 'marca'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'marca','descripcion'
    ];

    //funcion para filtrado
      public function scopeBuscar($query, $busqueda)
      {
          if ($busqueda != "") {
              $query->where('marca', "LIKE", "%$busqueda%");    

           }
      }
}
