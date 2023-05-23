<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherNameToJournalVirusTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_virus_tests', function (Blueprint $table) {
            $table->string('other_name')->nullable()->after('others');
            $table->integer('others_2')->default(2)->after('other_name');
            $table->string('other2_name')->nullable()->after('others_2');
            $table->integer('others_3')->default(2)->after('other2_name');
            $table->string('other3_name')->nullable()->after('others_3');
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
            $table->dropColumn('other_name');
            $table->dropColumn('others_2');
            $table->dropColumn('other2_name');
            $table->dropColumn('others_3');
            $table->dropColumn('other3_name');
        });
    }
}
