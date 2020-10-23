<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{

    public function run()
    {

      $services = [
        'wifi',
        'parking',
        'swim',
        'concierge',
        'sauna',
        'sea'
      ];

      foreach ($services as $service) {
        DB::table('services') -> insert ([
          'name' => $service
        ]);
      }

    }
}
