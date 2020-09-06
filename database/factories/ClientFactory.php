<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'ruc' => $faker->numberBetween($min = 1000, $max = 9000),
        'name' => $faker->name
    ];
});
