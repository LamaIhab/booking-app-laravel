<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // adding initial 12 seats unbooked for each bus
        for ($i = 0; $i < 12; $i++) {
            DB::table('seats')->insert([
                'bus_id' => 1,
                'user_id' => null
            ]);
            DB::table('seats')->insert([
                'bus_id' => 2,
                'user_id' => null
            ]);
            DB::table('seats')->insert([
                'bus_id' => 3,
                'user_id' => null
            ]);

        }
    }
}
