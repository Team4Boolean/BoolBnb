<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Flat;

$factory->define(Model::class, function (Faker $faker) {
    return [
      'title'     => $faker ->  sentence($nbWords = 6, $variableNbWords = true),
      'desc'      => $faker ->  paragraph($nbSentences = 3, $variableNbSentences = true),
      'n_rooms'   => $faker ->  randomDigitNotNull,
      'n_beds'    => $faker ->  randomDigitNotNull,
      'n_baths'   => $faker ->  randomDigitNotNull,
      'sqm'       => $faker ->  randomFloat($nbMaxDecimals = 2, $min = 1, $max = 2000),
      'lat'       => $faker ->  latitude($min = -90, $max = 90),
      'lon'       => $faker ->  longitude($min = -180, $max = 180),
      'img'       => $faker ->  imageUrl($width, $height, 'cats'),
      'wifi'      => $faker ->  boolean($chanceOfGettingTrue = 50),
      'parking'   => $faker ->
      'swim'      => $faker ->
      'concierge' => $faker ->
      'sauna'     => $faker ->
      'sea'       => $faker ->
      'visible'   => $faker ->
      'views'     => $faker ->
    ];
});
