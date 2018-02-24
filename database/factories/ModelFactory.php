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
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ? : $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'title'       => $faker->sentence,
        'content'     => $faker->text(500),
        'image'       => $faker->randomElement(['post1.jpg', 'post2.jpg', 'post3.jpg']),
        'publishDate' => $faker->date('d/m/Y'),
        'views'       => $faker->numberBetween(0, 500),
        'category_id' => $faker->numberBetween(1, 4),
        'user_id'     => 2,
        'published'   => $faker->randomElement([1, 0]),
        'is_featured' => $faker->randomElement([1, 0, 0]),
        'description' => $faker->text(150)
    ];
});