<?php

use Illuminate\Database\Seeder;

use App\View;
use App\Flat;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(View::class, 500)
          -> make()
          -> each(function($view) {
            $flat = Flat::inRandomOrder() -> first();
            $view -> flat() -> associate($flat);
            $view -> save();
          });
    }
}
