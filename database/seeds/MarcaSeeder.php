<?php

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Elimina registros existente
        // DB::table('marca')->truncate();

         $data=array(
         	[
         	'marca' => 'LA COST',
            'descripcion' => 'MARCA ITALIANA',

       		 ],
        	[
         	'marca' => 'ADIDAS',
            'descripcion' => 'MARCA JAPONESA',

       		 ],
            [
            'marca' => 'JEANS',
            'descripcion' => 'MARCA JAPONESA',

             ],
         );

        DB::table('marca')->insert($data);
    }
}
