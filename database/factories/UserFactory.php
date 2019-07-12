<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Faculty::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => mt_rand(1000000, 9999999), // secret
        'status' => array_rand(array('Teacher','Admin')),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    ];
});

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'fatherName' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => mt_rand(1000000, 9999999), // secret
        'secId' => rand(1,32),
        'joined' => Carbon::now()->toDateTimeString(),
        'address' => str_random(100),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    ];
});

// $factory->define(App\Subject::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'fatherName' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'phone' => mt_rand(1000000, 9999999), // secret
//         'secId' => rand(1,32),
//         'joined' => Carbon::now()->toDateTimeString(),
//         'address' => str_random(100),
//     ];
// });
