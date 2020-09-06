<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $cost = $faker->randomFloat(2, 10, 1000);
    return [
        'category_id' => \App\Category::all()->random()->id,
        'name' => $faker->name,
        'cost' => $cost,
        'price' => $cost * 1.5,
        'stock' => $faker->randomNumber(3, false)
    ];
});
