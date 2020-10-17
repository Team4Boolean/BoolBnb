<?php

use Illuminate\Database\Seeder;

use App\Sponsor;
use App\Flat;
use App\Advertising;

class SponsorSeeder extends Seeder
{

    public function run()
    {
      factory(Sponsor::class, 50)
      -> make() // genera 100 istanze del model Campaign
      -> each(function($cmp) {

        $flt =  Flat::inRandomOrder() -> first() -> id;
        $cmp -> flat_id = $flt;

        $adv =  Advertising::inRandomOrder() -> first();
        $cmp -> advertising() -> associate($adv);

        $cmp -> save();

      });
    }

}
