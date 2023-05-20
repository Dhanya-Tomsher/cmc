<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOthersToJournalVirusTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_virus_tests', function (Blueprint $table) {
            $table->integer('others')->default(0)->after('panleukopenia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journal_virus_tests', function (Blueprint $table) {
            $table->dropColumn('others');
        });
    }
}
