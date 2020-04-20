<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use App\Category;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(rand(10, 50)),
        'body' => $faker->realText(rand(1000, 2000)),
        'isPrivate' => $faker->boolean(50),
        'category_id' => $faker->numberBetween(1, 3)
    ];
});
