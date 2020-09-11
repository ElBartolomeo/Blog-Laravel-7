<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Category::class, function (Faker $faker) {
    $title = $faker->sentence(4); //oración de cuatro palabras
    return [
        'name' => $title,
        'slug' => Str::slug($title), //convierte un string a slug
        'body' => $faker->text(500), // crea un texto de 500 caracteres.
    ];
});
