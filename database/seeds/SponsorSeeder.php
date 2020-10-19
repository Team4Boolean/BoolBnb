<?php

use Illuminate\Database\Seeder;

use App\Sponsor;

class SponsorSeeder extends Seeder
{

    public function run() {

      $sponsors = [
        [
          'title' => 'packet1',
          'price' => '2.99',
          'hours' => '24'
        ],
        [
          'title' => 'packet2',
          'price' => '5.99',
          'hours' => '72'
        ],
        [
          'title' => 'packet3',
          'price' => '9.99',
          'hours' => '144'
        ]
      ];

      foreach ($sponsors as $sponsor) {
        DB::table('sponsors') -> insert ([
            'title' => $sponsor['title'],
            'price' => $sponsor['price'],
            'hours' => $sponsor['hours'],
        ]);
      }

    }

}
