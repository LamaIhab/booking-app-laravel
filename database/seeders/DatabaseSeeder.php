<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // calling tables seeders to run in order
        $this->call(BusSeeder::class);
        $this->call(TripSeeder::class);
        $this->call(SeatSeeder::class);
    }
}
