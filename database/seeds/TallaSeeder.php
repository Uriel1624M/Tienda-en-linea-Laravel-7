<?php

use Illuminate\Database\Seeder;

class TallaSeeder extends Seeder
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
         	'talla' => 'CHICA',
            'descripcion' => 'Talla de personas de estatura muy bajita y conplexion delgada',


       		 ],
        	[
         	'talla' => 'MEDIANA',
            'descripcion' => 'Recomendada para personas de complexion media',


       		 ],
            [
            'talla' => 'GRANDE',
            'descripcion' => 'Recomendada para personas de complexion Grande',

             ],
             
            [
            'talla' => 'XL-EXTRA-GRANDE',
            'descripcion' => 'Recomendada para personas de complexion muy grande',

             ],
         );

        DB::table('talla')->insert($data);
    
    }
}
