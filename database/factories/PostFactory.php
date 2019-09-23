<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Faker\Factory;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        "user_id" =>$faker->numberBetween(1,3),
        "body"=> Str::random(150)
    ];
});
