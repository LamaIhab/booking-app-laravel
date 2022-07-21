<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ------------------- Bus (1) trips ------------------------------------------------------ //
        DB::table('trips')->insert([
            'start_point' => "Cairo",
            'end_point' => "Fayum",
            "start_point_order" => 1,
            "end_point_order" => 2,
            "bus_id" => 1

        ]);

        DB::table('trips')->insert([
            'start_point' => "Cairo",
            'end_point' => "Minya",
            "start_point_order" => 1,
            "end_point_order" => 3,
            "bus_id" => 1

        ]);

        DB::table('trips')->insert([
            'start_point' => "Cairo",
            'end_point' => "Asyut",
            "start_point_order" => 1,
            "end_point_order" => 4,
            "bus_id" => 1

        ]);

        DB::table('trips')->insert([
            'start_point' => "Fayum",
            'end_point' => "Minya",
            "start_point_order" => 2,
            "end_point_order" => 3,
            "bus_id" => 1

        ]);

        DB::table('trips')->insert([
            'start_point' => "Fayum",
            'end_point' => "Asyut",
            "start_point_order" => 2,
            "end_point_order" => 4,
            "bus_id" => 1

        ]);

        DB::table('trips')->insert([
            'start_point' => "Minya",
            'end_point' => "Asyut",
            "start_point_order" => 3,
            "end_point_order" => 4,
            "bus_id" => 1

        ]);

        // ------------------- Bus (2) trips ------------------------------------------------------ //
        DB::table('trips')->insert([
            'start_point' => "Alexandria",
            'end_point' => "Tanta",
            "start_point_order" => 1,
            "end_point_order" => 2,
            "bus_id" => 2

        ]);

        DB::table('trips')->insert([
            'start_point' => "Alexandria",
            'end_point' => "Luxor",
            "start_point_order" => 1,
            "end_point_order" => 3,
            "bus_id" => 2

        ]);

        DB::table('trips')->insert([
            'start_point' => "Alexandria",
            'end_point' => "Giza",
            "start_point_order" => 1,
            "end_point_order" => 4,
            "bus_id" => 2

        ]);

        DB::table('trips')->insert([
            'start_point' => "Tanta",
            'end_point' => "Luxor",
            "start_point_order" => 2,
            "end_point_order" => 3,
            "bus_id" => 2

        ]);

        DB::table('trips')->insert([
            'start_point' => "Tanta",
            'end_point' => "Giza",
            "start_point_order" => 2,
            "end_point_order" => 4,
            "bus_id" => 2

        ]);

        DB::table('trips')->insert([
            'start_point' => "Luxor",
            'end_point' => "Giza",
            "start_point_order" => 3,
            "end_point_order" => 4,
            "bus_id" => 2

        ]);

        // ------------------- Bus (3) trips ------------------------------------------------------ //

        DB::table('trips')->insert([
            'start_point' => "Ismailia",
            'end_point' => "Tanta",
            "start_point_order" => 1,
            "end_point_order" => 2,
            "bus_id" => 3

        ]);

        DB::table('trips')->insert([
            'start_point' => "Ismailia",
            'end_point' => "Luxor",
            "start_point_order" => 1,
            "end_point_order" => 3,
            "bus_id" => 3

        ]);

        DB::table('trips')->insert([
            'start_point' => "Ismailia",
            'end_point' => "Qina",
            "start_point_order" => 1,
            "end_point_order" => 4,
            "bus_id" => 3

        ]);

        DB::table('trips')->insert([
            'start_point' => "Tanta",
            'end_point' => "Luxor",
            "start_point_order" => 2,
            "end_point_order" => 3,
            "bus_id" => 3

        ]);

        DB::table('trips')->insert([
            'start_point' => "Tanta",
            'end_point' => "Qina",
            "start_point_order" => 2,
            "end_point_order" => 4,
            "bus_id" => 3

        ]);

        DB::table('trips')->insert([
            'start_point' => "Luxor",
            'end_point' => "Qina",
            "start_point_order" => 3,
            "end_point_order" => 4,
            "bus_id" => 3

        ]);
    }
}
