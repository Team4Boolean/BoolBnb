<?php

use Illuminate\Database\Seeder;

use App\Campaign;
use App\Flat;
use App\Advertising;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Campaign::class, 50)
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
