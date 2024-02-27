<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(1)->after('password');
            $table->enum('user_type', ['admin', 'staff'])->default('staff')->after('name');
            $table->string('phone_number')->nullable()->after('email');
            $table->boolean('is_deleted')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('user_type');
            $table->dropColumn('phone_number');
            $table->dropColumn('is_deleted');
        });
    }
}
