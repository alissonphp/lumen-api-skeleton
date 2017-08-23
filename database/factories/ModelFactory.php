<?php

$factory->define(\App\Modules\Users\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $password ?: $password = bcrypt('lumenauth123'),
        'remember_token' => str_random(10),
    ];
});