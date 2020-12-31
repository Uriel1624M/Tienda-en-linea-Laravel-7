<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=array(
         	[
         	'nombre' => 'Vestidos',
            'descripcion' => 'Vestidos para dama',

       		 ],
        	[
         	'nombre' => 'PLAYERAS',
            'descripcion' => 'PLayera para caballero marcas internacionales',

       		 ],
            [
            'nombre' => 'SUDADERAS',
            'descripcion' => 'Sudadera para caballero marcas internacionales',

             ],
            [
            'nombre' => 'PANTALONES',
            'descripcion' => 'PLayera para caballero marcas internacionales',

             ],
         );

        DB::table('categoria')->insert($data);
    }
}
