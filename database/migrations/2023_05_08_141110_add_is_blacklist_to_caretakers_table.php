<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBlacklistToCaretakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caretakers', function (Blueprint $table) {
            $table->text('blacklist_reason')->nullable();
            $table->boolean('is_blacklist')->default(0);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caretakers', function (Blueprint $table) {
            $table->dropColumn('blacklist_reason');
            $table->dropColumn('is_blacklist');
        });
    }
}
