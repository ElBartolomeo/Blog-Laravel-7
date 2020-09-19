<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence(4); //oración de cuatro palabras
    return [
        'user_id'=> rand(1,30), //Número aleatorio del 1 al 30
        'category_id'=> rand(1,20), //Número aleatorio del 1 al 20
        'name' => $title,
        'slug' => Str::slug($title), //convierte un string a slug
        'excerpt' => $faker->text(200), // crea un texto de 200 caracteres.
        'body' => $faker->text(500), // crea un texto de 500 caracteres.
        'file'=> $faker->imageUrl($width = 1200, $height = 400),
        'status'=> $faker->randomElement(['DRAFT','PUBLISHED']),
        
    ];
});
