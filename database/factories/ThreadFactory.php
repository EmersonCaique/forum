<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph,
        'body' => $faker->sentence,
        'user_id' => create('App\User'),
        'channel_id' => create('App\Channel'),
    ];
});
