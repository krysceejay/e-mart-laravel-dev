<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
      'user_id' => 2,
      'name' => $faker->name,
      'old_price' => 2000,
      'new_price' => 1500,
      'description' => $faker->sentence, // password
      'display_image' => "img.jpg",
    ];
});
