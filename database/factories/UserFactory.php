<?php

use Faker\Generator as Faker;

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
        'email' => $faker->unique()->safeEmail,
        'userName' => $faker->name,
        'password' => bcrypt('himel6854@'), // secret
        'photo' => $faker->imageUrl(),
        'remember_token' => str_random(10),
        'email_varified' => 1,
        'email_varified_at' => \Carbon\Carbon::now(),
        'email_varified_token' =>'',
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
  $name=$faker->name;
    return [
        'name' => $faker->name,
        'slug' => str_slug($name), // secret

    ];
});
$factory->define(App\Post::class, function (Faker $faker) {
  $name=$faker->name;
    return [
        'user_id' => random_int(1, 10),
        'category_id' => random_int(1, 10),
        'title'=>$faker->realText(30),
        'content'=>$faker->realText(),
        'image_path'=>$faker->imageUrl(),

    ];
});