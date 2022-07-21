<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // inserting 3 busses with their start and end points

        DB::table('busses')->insert([
            'start_point' => "Cairo",
            'end_point' => "Asyut"

        ]);

        DB::table('busses')->insert([
            'start_point' => "Ismailia",
            'end_point' => "Qina"

        ]);

        DB::table('busses')->insert([
            'start_point' => "Alexandria",
            'end_point' => "Giza"

        ]);
    }
}
