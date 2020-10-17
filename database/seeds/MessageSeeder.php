<?php

use Illuminate\Database\Seeder;

use App\Message;
use App\Flat;

class MessageSeeder extends Seeder
{
  
    public function run()
    {

      factory(Message::class, 100)
      -> make() // genera 100 istanze del model Request
      -> each(function($request) {
        $flat = Flat::inRandomOrder() -> first();
        $request -> flat() -> associate($flat);
        $request -> save();
      });

    }
}
