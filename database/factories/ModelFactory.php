<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});




$factory->define(App\Repair::class, function (Faker\Generator $faker) {
    //static $password;

    return [
        'login' => $faker->name,
        'street' => $faker->streetName,
        'build' => $faker->buildingNumber,
        'phone_num' => $faker->phoneNumber,
        'vlan_name' => $faker->randomNumber,
        'cause' => $faker->sentence,
        'ticket_status_id' => rand(1,4),
        'city_id' => rand(1,4),
        'create_user_id' => rand(1,2),
        'close_user_id' => rand(13,14),


    ];
});




$factory->define(App\Join::class, function (Faker\Generator $faker) {
    //static $password;

    return [
        
        'street' => $faker->streetName,
        'build' => $faker->buildingNumber,
        'full_name' => $faker->name,
        'phone_num' => $faker->phoneNumber,
        'comment' => $faker->sentence,
        'ticket_status_id' => rand(1,4),
        'city_id' => rand(1,4),
        'create_user_id' => rand(1,2),
        'close_user_id' => rand(13,14),


    ];
});

