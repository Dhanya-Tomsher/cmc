<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('cat_id');
            $table->string('vet_id')->nullable();
            $table->date('date_appointment')->nullable();
            $table->string('time_appointment')->nullable();
            $table->boolean('caretaker_id')->nullable();
            $table->string('reason')->nullable();
            $table->string('vet_comment')->nullable();
            $table->string('medicine')->nullable();
            $table->string('caretaker_comment')->nullable();
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
        Schema::dropIfExists('hospital_appointments');
    }
}
