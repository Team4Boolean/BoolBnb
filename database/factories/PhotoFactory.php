<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Photo;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'url' => $faker ->  imageUrl($width = 640, $height = 480)
    ];
});
