<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Articulo;
use App\Articulotalla;


//libreria de reportes exel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticulosExistenciaExport;

 


class ExcelController extends Controller
{
    //

     public function index() {

      return Excel::download(new ArticulosExistenciaExport, 'ExistenciaArticulos.xlsx');
        

    }

}
