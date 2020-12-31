<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Elimina registros existente
        // DB::table('users')->truncate();

         $data=array(
         	[
         	'name' => 'Alarcon',
            'last_name' => 'Ramirez Gonzales',
            'email' => 'alarcon@gmail.com',
            'password' => bcrypt('invitado12345'),
            'type' => 'admin',
            'active' => '1',
            'address' => 'Calle Santa teresa S/N',
            'url_imagen'=>'',

        ],
        	[
         	'name' => 'Diana',
            'last_name' => 'Ramirez Reyes',
            'email' => 'diana@gmail.com',
            'password' => bcrypt('invitado12345'),
            'type' => 'user',
            'active' => '1',
            'address' => 'Calle Santa teresa S/N',
            'url_imagen'=>'',

        ],
         );

        DB::table('users')->insert($data);
    }
}
