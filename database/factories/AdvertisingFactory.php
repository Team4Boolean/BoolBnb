<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Advertising;

$factory->define(Advertising::class, function (Faker $faker) {
    return [
        'title' => '',
        'price' => '',
        'hours' => ''
    ];
});
