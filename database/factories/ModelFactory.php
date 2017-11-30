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
        'username' => $faker->word,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role_id' => 1,
        'active' => true
    ];
});

$factory->define(App\Tour::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = '-1 Months', $endDate = '1 Months', $timezone = null),
        'time' => $faker->time
    ];
});

$factory->define(App\Major::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'code' => $faker->word,
        'undergraduate' => 1,
        'graduate' => 0,
        'active' => 1
    ];
});

$factory->define(App\Attendee::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'visitors'=> $faker->randomDigit,
        'phone' => $faker->tollFreePhoneNumber,
        'considerations' => $faker->text
    ];
});
