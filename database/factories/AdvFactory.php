<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Adv;

$factory->define(Adv::class, function (Faker $faker) {
    return [
      'package' => $faker -> numberBetween($min = 0, $max = 2),
      'expire'  => $faker -> dateTimeBetween($startDate = 'now', $endDate = '2020-12-25 08:37:17', $timezone = null)
    ];
});
