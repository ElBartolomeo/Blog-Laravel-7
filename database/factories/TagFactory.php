<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Tag::class, function (Faker $faker) {
    $title = $faker->unique()->word(5); //Una palabra de 5 caracteres
    return [
        'name' => $title,
        'slug' => Str::slug($title), //convierte un string a slug
    ];
});
