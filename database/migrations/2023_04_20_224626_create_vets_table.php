<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->longText('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->integer('home_country')->nullable();
            $table->string('emirate')->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('color_name')->nullable();
            $table->string('color_code')->nullable();
            $table->string('emirates_id')->nullable();
            $table->string('license_number')->nullable();
            $table->string('designation')->nullable();
            $table->string('specialization')->nullable(); 
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
        Schema::dropIfExists('vets');
    }
}
