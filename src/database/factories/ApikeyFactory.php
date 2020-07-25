<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Apikeys;
use Faker\Generator as Faker;

$factory->define(Apikeys::class, function (Faker $faker) {
    return [
      'name' => "APP-KEY",
      'key' => "DFGHtyhHHHji2j9JcL4aGnTV4Cdp2x3yPTYKRndAnbii787trty",
      'active' => 1,
      'user_id' => factory(App\User::class)
    ];
});
