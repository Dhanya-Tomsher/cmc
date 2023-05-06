<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNeuteredToCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->boolean('neutered')->default(0);
            $table->boolean('neutered_with_us')->default(0);
            $table->boolean('spayed')->default(0);
            $table->boolean('pregnant')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn('neutered');
            $table->dropColumn('neutered_with_us');
            $table->dropColumn('spayed');
            $table->dropColumn('pregnant');
        });
    }
}
