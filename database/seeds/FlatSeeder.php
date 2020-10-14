<?php

use Illuminate\Database\Seeder;

use App\Flat;
use App\User;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Flat::class, 100)
      -> make() // genera 100 istanze del model Flat
      -> each(function($flat) {
        $usr = User::inRandomOrder() -> first();
        $flat -> user() -> associate($usr);
        $flat -> save();
      });
    }
}
