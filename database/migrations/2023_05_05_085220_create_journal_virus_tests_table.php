<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalVirusTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_virus_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('calicivirus')->default(0);
            $table->integer('coronavirus')->default(0);
            $table->integer('herpesvirus')->default(0);
            $table->integer('felv')->default(0);
            $table->integer('fiv')->default(0);
            $table->integer('panleukopenia')->default(0);
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
        Schema::dropIfExists('journal_virus_tests');
    }
}
