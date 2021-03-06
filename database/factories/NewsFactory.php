<?php

/** @var Factory $factory */

use App\News;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->text,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTime,
        'user_id' => null,
    ];
});
