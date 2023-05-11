<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->enum('booking_type', ['hospital_appointment', 'hotel_booking'])->default(null);
            $table->float('price', 6, 2)->default(0.00);
            $table->float('net', 6, 2)->default(0.00);
            $table->float('vat', 6, 2)->default(0.00);
            $table->float('net_vat', 6, 2)->default(0.00);
            $table->float('service_charge', 6, 2)->default(0.00);
            $table->float('total', 6, 2)->default(0.00);
            $table->date('invoice_date')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
