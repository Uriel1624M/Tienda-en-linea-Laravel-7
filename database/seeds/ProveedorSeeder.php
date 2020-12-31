<?php

use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
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
         	'nombre' => 'Alarcon Gonzales Rivera',
            'email' => 'Gonzales@hotmail.com',
            'telefono' => '755 666 899',
            'direccion' => 'Avenida Principal San nicolas de las garzas',

       		 ],
        	[
         	'nombre' => 'Martina Rivaz Gonzales',
            'email' => 'Martina@hotmail.com',
            'telefono' => '755 666 899',
            'direccion' => 'Avenida Principal Rio de las garzas',
            

       		 ],
            [
            'nombre' => 'Sofia Perez Perez',
            'email' => 'Sofia@hotmail.com',
            'telefono' => '755 666 899',
            'direccion' => 'Avenida Principal San jose de las garzas',
           
             ],
         );

        DB::table('proveedor')->insert($data);
    
    }
}
