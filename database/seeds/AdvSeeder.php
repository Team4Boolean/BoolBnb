<?php

use Illuminate\Database\Seeder;

use App\Adv;
use App\Flat;

class AdvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Adv::class, 100)
      -> make() // genera 100 istanze del model Adv
      -> each(function($adv) {
        $flat = Flat::inRandomOrder() -> first();
        $adv -> flat() -> associate($flat);
        $adv -> save();
      });
    }
}
