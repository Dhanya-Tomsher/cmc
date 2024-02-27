<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferToCaretakerToCatCaretakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_caretakers', function (Blueprint $table) {
            $table->integer('transfer_to_caretaker')->nullable()->after('caretaker_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_caretakers', function (Blueprint $table) {
            $table->dropColumn('transfer_to_caretaker');
        });
    }
}
