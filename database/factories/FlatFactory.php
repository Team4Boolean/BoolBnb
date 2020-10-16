<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Flat;

$factory->define(Flat::class, function (Faker $faker) {
    return [
      'title'         =>  $faker -> sentence($nbWords = 6, $variableNbWords = true),
      'desc'          =>  $faker -> paragraph($nbSentences = 3, $variableNbSentences = true),
      'rooms'         =>  $faker -> randomDigitNotNull,
      'beds'          =>  $faker -> randomDigitNotNull,
      'baths'         =>  $faker -> randomDigitNotNull,
      'sqm'           =>  $faker -> randomFloat($nbMaxDecimals = 2, $min = 1, $max = 2000),
      'lat'           =>  $faker -> latitude($min = -90, $max = 90),
      'lon'           =>  $faker -> longitude($min = -180, $max = 180),
      'street_number' =>  $faker -> buildingNumber,
      'street_name'   =>  $faker -> streetName,
      'municipality'  =>  $faker -> state,
      'subdivision'     =>  $faker -> city,
      'postal_code'   =>  $faker -> postcode,
      'img'           => $faker ->  imageUrl($width = 640, $height = 480),
      'visible'       => $faker ->  boolean(true),
    ];
});
