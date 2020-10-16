<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          UserSeeder::class,
          ServiceSeeder::class,
          FlatSeeder::class,
          ViewSeeder::class,
          RequestSeeder::class,
          AdvSeeder::class,
          CampaignSeeder::class 
        ]);
    }
}
