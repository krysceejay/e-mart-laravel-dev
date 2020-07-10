<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Cart;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
      'user_id' => 2,
      'item_id' => 3,
      'unit' => 4,
    ];
});
