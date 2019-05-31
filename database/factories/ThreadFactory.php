<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph,
        'body' => $faker->sentence,
        'user_id' => factory('App\User')->create(),
    ];
});
