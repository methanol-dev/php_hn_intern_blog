<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title, '-');

    return [
        'user_id' => factory(User::class)->create()->id,
        'title' => $title,
        'content' => $faker->paragraph,
        'images' => 'default.jpg',
        'status' => Post::PENDING,
        'slug' => $slug,
    ];
});
