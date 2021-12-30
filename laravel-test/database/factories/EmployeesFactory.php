<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employees;
use Faker\Generator as Faker;

$factory->define(Employees::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'company_id' => rand(1,20)
    ];
});
