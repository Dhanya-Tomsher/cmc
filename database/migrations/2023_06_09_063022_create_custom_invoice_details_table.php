<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_invoice_id');
            $table->foreign('custom_invoice_id')->references('id')->on('custom_invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->text('procedure');
            $table->integer('quantity')->default(0);
            $table->float('unit_price', 6, 2)->default(0.00);
            $table->float('net', 6, 2)->default(0.00);
            $table->float('vat', 6, 2)->default(0.00);
            $table->float('net_vat', 6, 2)->default(0.00);
            $table->float('service_charge', 6, 2)->default(0.00);
            $table->float('total', 6, 2)->default(0.00);
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
        Schema::dropIfExists('custom_invoice_details');
    }
}
