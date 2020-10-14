<?php

use Illuminate\Database\Seeder;

use App\Request;
use App\Flat;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Request::class, 100)
      -> make() // genera 100 istanze del model Request
      -> each(function($request) {
        $flat = Flat::inRandomOrder() -> first();
        $request -> flat() -> associate($flat);
        $request -> save();
      });
    }
}
