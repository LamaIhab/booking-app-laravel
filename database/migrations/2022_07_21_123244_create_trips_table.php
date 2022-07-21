<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('start_point');
            $table->string('end_point');
            // represents order of start point and end point in bus trip
            $table->integer('start_point_order');
            $table->integer('end_point_order');
            $table->integer('available_seats')->default(12);
            $table->timestamps();
        });

        // creating foreign key bus_id to reference bus where this trip belongs to
        Schema::table('trips', function (Blueprint $table) {
            $table->foreignId('bus_id')->constrained('busses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
