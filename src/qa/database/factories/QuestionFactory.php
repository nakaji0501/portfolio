<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5, 10)), "."),
        'text' => $faker->paragraphs(rand(3, 7), true),
        // 'user_id' => $faker->numberBetween(3, 4),
    ];
});
