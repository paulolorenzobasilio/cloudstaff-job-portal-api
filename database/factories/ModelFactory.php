<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Admin;
use App\Model\Employer;
use App\Model\JobApplicant;
use App\Model\Job;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => Hash::make('password')
    ];
});

$factory->define(Employer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(5),
        'email' => $faker->unique()->email,
        'password' => Hash::make('password')
    ];
});

$factory->define(Job::class, function (Faker $faker) {
    $title = $faker->sentence(3);
    $salary_min = ['10000', '20000','30000', '40000', '50000'];
    $salary_max = ['60000', '70000','80000', '90000', '100000'];

    return [
        'title' => $title,
        'title_slug' => Str::slug($title . ' ' . rand(0,9999)),
        'description' => $faker->paragraph(5),
        'requirements' => $faker->paragraph(5),
        'location' => $faker->sentence(),
        'salary_min' => $salary_min[array_rand($salary_min)],
        'salary_max' => $salary_max[array_rand($salary_max)],
        'employer_id' => factory(Employer::class),
        'posted' => rand(0,1)
    ];
});

$factory->define(JobApplicant::class, function (Faker $faker){
    return [
        'job_id' => factory(Job::class),
        'name' => $faker->name(),
        'email' => $faker->unique()->email,
        'resume_link' => $faker->url,
    ];
});