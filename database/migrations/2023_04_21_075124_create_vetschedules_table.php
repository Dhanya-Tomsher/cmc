<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVetSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vet_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('title');
            $table->integer('vet_id');
            $table->string('available_from');
            $table->string('available_to');
            $table->string('date')->nullable();
            $table->integer('slot_interval')->nullable(); 
            $table->boolean('availability')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->enum('status', ['published', 'draft'])->default('draft');
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
        Schema::dropIfExists('vet_schedules');
    }
}
