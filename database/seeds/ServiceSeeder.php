<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{

    public function run()
    {

      $services = [
        'WiFi',
        'Posto Macchina',
        'Piscina',
        'Portineria',
        'Sauna',
        'Vista Mare'
      ];

      foreach ($services as $service) {
        DB::table('services') -> insert ([
          'name' => $service
        ]);
      }

    }
}
