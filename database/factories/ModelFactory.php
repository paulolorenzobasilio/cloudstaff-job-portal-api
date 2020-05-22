<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Admin;
use App\Model\Employer;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Admin::class, function (Faker $faker){
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => Hash::make('password')
    ];
});

$factory->define(Employer::class, function (Faker $faker){
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(5),
        'email' => $faker->unique()->email,
        'password' => Hash::make('password')
    ];
});
