<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cat_id')->nullable();
            $table->date('date_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('blood_type')->nullable();
            $table->boolean('castrated')->default(0);
            $table->string('fur_color')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('work_place')->nullable();
            $table->integer('place_of_origin')->nullable();
            $table->string('emirate')->nullable();
            $table->longText('origin')->nullable();
            $table->string('microchip_number')->nullable();
            $table->boolean('dead_alive')->default(1);  
            $table->string('image_url')->nullable();   
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
        Schema::dropIfExists('cats');
    }
}
