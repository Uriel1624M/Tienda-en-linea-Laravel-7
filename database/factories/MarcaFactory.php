<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marca;
use Faker\Generator as Faker;

$factory->define(Marca::class, function (Faker $faker) {
    return [
        //
        'marca'=>$this->faker->name,
        'descripcion'=>$this->faker->text,
    ];
});
