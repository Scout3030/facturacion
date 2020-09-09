<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'document_id' => \App\Document::all()->random()->id,
        'document_number' => $faker->numberBetween($min = 1000, $max = 9000),
        'title' => $faker->name,
        'address' => $faker->sentence
    ];
});
