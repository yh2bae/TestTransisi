<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Companies;
use Faker\Generator as Faker;

$factory->define(Companies::class, function (Faker $faker) {
    return [
        'nama' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'logo' => 'https://source.unsplash.com/random',
        'website' => $faker->url
    ];
});
