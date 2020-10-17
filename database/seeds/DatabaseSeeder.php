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
          VisitSeeder::class,
          MessageSeeder::class,
          AdvSeeder::class,
          SponsorSeeder::class
        ]);
    }
}
