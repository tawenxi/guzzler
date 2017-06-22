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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,

    ];
});

$factory->define(App\Model\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,

    ];
});

//-----------
$factory->define(App\Model\Cost::class, function (Faker\Generator $faker) {
    return [
        'payee' => $faker->word,
        'payeeaccount' => '123456',
        'payeebanker' => '123456',
        'amount' => '1',
        'zhaiyao' => $faker->word,


    ];
});

$factory->define(App\Model\Income::class, function (Faker\Generator $faker) {
    return [
        'date' => '2016',
        'zhaiyao' => $faker->sentence,
        'xingzhi' => $faker->word,
        'amount' => '100',
        'cost' => '1',

    ];
});
