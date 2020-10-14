<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Flat;

$factory->define(Flat::class, function (Faker $faker) {
    return [
      'title'     => $faker ->  sentence($nbWords = 6, $variableNbWords = true),
      'desc'      => $faker ->  paragraph($nbSentences = 3, $variableNbSentences = true),
      'rooms'     => $faker ->  randomDigitNotNull,
      'beds'      => $faker ->  randomDigitNotNull,
      'baths'     => $faker ->  randomDigitNotNull,
      'sqm'       => $faker ->  randomFloat($nbMaxDecimals = 2, $min = 1, $max = 2000),
      'lat'       => $faker ->  latitude($min = -90, $max = 90),
      'lon'       => $faker ->  longitude($min = -180, $max = 180),
      'img'       => $faker ->  imageUrl($width = 640, $height = 480, 'cats'),
      'wifi'      => $faker ->  boolean($chanceOfGettingTrue = 50),
      'parking'   => $faker ->  boolean($chanceOfGettingTrue = 50),
      'swim'      => $faker ->  boolean($chanceOfGettingTrue = 50),
      'concierge' => $faker ->  boolean($chanceOfGettingTrue = 50),
      'sauna'     => $faker ->  boolean($chanceOfGettingTrue = 50),
      'sea'       => $faker ->  boolean($chanceOfGettingTrue = 50),
      'visible'   => $faker ->  boolean(true),
      'views'     => $faker ->  randomNumber($nbDigits = 6, $strict = false)
    ];
});
