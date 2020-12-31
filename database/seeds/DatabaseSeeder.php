<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(MarcaSeeder::class);
         $this->call(CategoriaSeeder::class); 
        $this->call(ArticuloSeeder::class);
        $this->call(TallaSeeder::class);
        $this->call(ArticuloTallaSeeder::class);
        $this->call(ProveedorSeeder::class);






    }
}
