<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotelrooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->string('room_type')->nullable();
            $table->string('facilities')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('room_status')->default(1);
            $table->boolean('status')->default(1);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotelrooms');
    }
}
