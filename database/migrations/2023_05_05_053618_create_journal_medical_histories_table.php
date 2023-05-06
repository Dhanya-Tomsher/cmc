<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('weight')->nullable();
            $table->string('temperature')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->date('report_date');
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
        Schema::dropIfExists('journal_medical_histories');
    }
}
