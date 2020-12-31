<?php

namespace App\Exports;

use App\Articulo;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticulosExistenciaExport implements /*FromQuery,*/FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	$articulos=Articulo::join('articulotalla','articulotalla.id_articulo','=','articulo.id')
        ->join('talla','talla.id','=','articulotalla.id_talla')
        ->select('articulo.id','articulo.nombre','articulo.url_imagen','articulotalla.sku','talla.talla',DB::raw('sum(articulotalla.stock) as stock'),'articulo.precio',
    		DB::raw('sum(articulotalla.stock* articulo.precio) as subtotal'))->orderBy('nombre')
            ->groupBy('articulotalla.id_articulo','articulotalla.id_talla')
        	->get();
        return $articulos;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array {
    	return [
    		'#',
    		'NOMBRE','URL IMAGEN','SKU','TALLA','STOCK','PRECIO UNITARIO','SUB TOTAL',
    	];
    }

}
