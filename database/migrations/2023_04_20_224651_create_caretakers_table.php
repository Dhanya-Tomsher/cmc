<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaretakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caretakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('customer_id')->nullable();
            $table->string('email')->unique();
            $table->longText('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->integer('home_country')->nullable();
            $table->string('emirate')->nullable();
            $table->string('work_place')->nullable();
            $table->longText('work_address')->nullable();
            $table->string('position')->nullable();
            $table->string('work_contact_number')->nullable();
            $table->boolean('is_passport_no')->default(1);
            $table->string('passport_number')->nullable();
            $table->boolean('is_emirates_id')->default(1);
            $table->string('emirates_id_number')->nullable();
            $table->string('visa_status')->nullable();
            $table->integer('number_of_registered_cats')->nullable();
            $table->string('image_url')->nullable();
            $table->longText('comments')->nullable();          
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
        Schema::dropIfExists('caretakers');
    }
}
