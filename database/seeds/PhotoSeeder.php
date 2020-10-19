<?php

use Illuminate\Database\Seeder;

use App\Photo;
use App\Flat;

class PhotoSeeder extends Seeder
{

    public function run()
    {
      factory(Photo::class, 300)
        -> make()
        -> each(function($photo) {
          $flat = Flat::inRandomOrder() -> first();
          $photo -> flat() -> associate($flat);
          $photo -> save();
        });
    }

}
