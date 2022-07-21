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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            // flag to mark whether this seat is booked or not
            $table->boolean('booked')->default(0);
            $table->timestamps();
        });

        // creating foreign key bus_id to reference bus where this seat belongs to
        Schema::table('seats', function (Blueprint $table) {
            $table->foreignId('bus_id')->constrained('busses');
        });

        // creating foreign key user_id to reference user that booked this seat if it is booked
        Schema::table('seats', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
};
