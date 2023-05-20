<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('caretaker_id');
            $table->integer('cat_id');
            $table->integer('form_id');
            $table->string('signature_url')->nullable();
            $table->date('signed_date')->nullable();
            $table->boolean('signed_status')->default(0);
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
        Schema::dropIfExists('custom_forms');
    }
}
