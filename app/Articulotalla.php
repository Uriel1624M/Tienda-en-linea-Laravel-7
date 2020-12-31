<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//libreria empleada para generar sku dianamico
use BinaryCats\Sku\HasSku;

use BinaryCats\Sku\Concerns\SkuOptions;

class Articulotalla extends Model
{
    //
    use HasSku;
    protected $table = 'articulotalla'; // Nombre de la tabla
     protected $primaryKey = 'id'; // Clave primaria

    
    protected $fillable = [
        'sku','id_articulo','id_talla','stock'
    ];

     public function skuOptions() : SkuOptions
    {
        return SkuOptions::make()
            ->from(['label', 'id_articulo'])
            ->target('sku')
            ->using('-')
            ->forceUnique(false)
            ->generateOnCreate(true)
            ->refreshOnUpdate(false);
    }


}
