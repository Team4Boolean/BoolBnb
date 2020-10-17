<?php

use Illuminate\Database\Seeder;

use App\Visit;
use App\Flat;

class VisitSeeder extends Seeder
{

    public function run()
    {

      factory(Visit::class, 500)
        -> make()
        -> each(function($view) {
          $flat = Flat::inRandomOrder() -> first();
          $view -> flat() -> associate($flat);
          $view -> save();
        });

    }
}
