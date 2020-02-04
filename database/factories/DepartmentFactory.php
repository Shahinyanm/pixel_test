<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;
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

$factory->define(Department::class, function (Faker $faker)  {
    return [
        'name' => $faker->company,
        'description' =>$faker->text,
        'logo' =>$faker->image('public/storage/logos',150,120, null, false)
    ];
});
