<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Photo;

$factory->define(Photo::class, function (Faker $faker) {

    $photos = [
      'https://cf.bstatic.com/images/hotel/max1024x768/153/153941057.jpg',
      'https://assetstools.cosentino.com/api/v1/bynder/image/9A097A3D-0BA3-45B4-A93FE7B345B54EE9/apartment-34-kitchen.jpg?auto=compress%2Cformat&w=1960&h=920',
      'https://cf.bstatic.com/images/hotel/max1024x768/173/173894281.jpg',
      'https://static.budgetplaces.com/establishment/55/86/28655/1.jpg',
      'https://www.heartmilanapartments.com/wp-content/uploads/as.jpg',
      'https://fishhotels-api.derbyhotels.com/storage/grehd/5de65cb941c4a8ccfce487d1/m/aramunt-barcelona-apartment-8.jpg'
    ];

    return [
        // 'url' => $faker ->  imageUrl($width = 640, $height = 480)
        'url' => $photos[array_rand($photos, 1)]
    ];
});
