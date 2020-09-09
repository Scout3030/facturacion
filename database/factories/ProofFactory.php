<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Proof;
use Faker\Generator as Faker;

$factory->define(Proof::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(1, true),
        'name' => $faker->word
    ];
});
