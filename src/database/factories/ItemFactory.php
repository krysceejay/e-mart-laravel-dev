<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Item::class, function (Faker $faker) {

    $name = $faker->name;
    $slug = Str::slug($name, '-');

    return [
      'user_id' => 1,
      'name' => $name,
      'old_price' => 2000,
      'new_price' => 1500,
      'description' => $faker->sentence, // password
      'display_image' => "img.jpg",
      'slug' => $slug
    ];
});
