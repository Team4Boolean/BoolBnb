<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Campaign;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'expire'  => $faker -> dateTimeBetween($startDate = 'now', $endDate = '2020-12-25 08:37:17', $timezone = null)
    ];
});
