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
    $first_name = $faker->firstName;
    $last_name = $faker->lastName;

    return [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => implode('',[strtolower($first_name), '_', strtolower($last_name), '@gmail.com']),
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->afterCreatingState(App\User::class, 'client', function (App\User $user, Faker $faker) {
    $client_group_id = App\Group::where('name', '=', 'client')->first();
    $user->groups()->attach($client_group_id);
});

$factory->afterCreatingState(App\User::class, 'admin', function (App\User $user, Faker $faker) {
    $client_group_id = App\Group::where('name', '=', 'client')->first();
    $user->groups()->attach($client_group_id);
    $admin_group_id = App\Group::where('name', '=', 'admin')->first();
    $user->groups()->attach($admin_group_id);
});
