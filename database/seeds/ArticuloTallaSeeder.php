<?php

use Illuminate\Database\Seeder;

class ArticuloTallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert into articulotallacolor(id_articulo,id_talla,stock) values(1,3,20);

        $data=array(
         	[
            'sku' => 'md-s112',
         	  'id_articulo' => '1',
            'id_talla' => '1',
            'stock' => '1',

       		 ],[
            'sku' => 'md-s11',
          	'id_articulo' => '1',
            'id_talla' => '2',
            'stock' => '1',

       		 ],[
            'sku' => 'md-s11267',
         	  'id_articulo' => '2',
            'id_talla' => '2',
            'stock' => '1',

       		 ],[
            'sku' => 'md-s114',
         	  'id_articulo' => '2',
            'id_talla' => '3',
            'stock' => '1',

       		 ],[
            'sku' => 'ms-98',
         	  'id_articulo' => '3',
            'id_talla' => '1',
            'stock' => '1',

       		 ],[
            'sku' => 'ms-986',
         	  'id_articulo' => '4',
            'id_talla' => '1',
            'stock' => '1',

       		 ],[
            'sku' => 'ms-989',
         	  'id_articulo' => '4',
            'id_talla' => '2',
            'stock' => '1',

       		 ],[
            'sku' => 'ms-98666',
         	  'id_articulo' => '5',
            'id_talla' => '1',
            'stock' => '1',

       		 ],
       		 [
            'sku' => 'ms-98777',
         	  'id_articulo' => '6',
            'id_talla' => '1',
            'stock' => '1',

       		 ],[
            'sku' => 'ms-98234',
         	  'id_articulo' => '7',
            'id_talla' => '1',
            'stock' => '1',

       		 ],
       		 [
            'sku' => 'ms-983456',
         	  'id_articulo' => '8',
            'id_talla' => '1',
            'stock' => '1',

       		 ],

         );

        DB::table('articulotalla')->insert($data);
    }
}
