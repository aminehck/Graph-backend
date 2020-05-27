<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Graph;
use Faker\Generator as Faker;

$factory->define(Graph::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'description' => $faker->text(50),
    ];
});
