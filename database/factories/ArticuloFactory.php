<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo;
use Faker\Generator as Faker;

$factory->define(Articulo::class, function (Faker $faker) {
    return [
        //
        'cod'=>$this->faker->phone,
        'nombre'=>$this->faker->name,
        'extract'=>$this->faker->text,
        'descripcion'=>$this->faker->text,
         'url_imagen'=>$this->faker->images,
         'visible'=>'1',
         'precio'=>'190',
         'id_marca'=>'1',
         'id_categoria'=>'1',

    ];
});
