<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTypeToHospitalAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hospital_appointments', function (Blueprint $table) {
            $table->enum('payment_type', ['online', 'pos_cash'])->default('online')->after('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hospital_appointments', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });
    }
}
