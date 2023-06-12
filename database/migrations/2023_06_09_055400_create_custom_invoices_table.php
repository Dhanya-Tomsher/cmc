<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('vet_id');
            $table->string('vet_name');
            $table->string('cat_name');
            $table->text('invoice_note')->nullable();
            $table->float('net', 6, 2)->default(0.00);
            $table->float('vat', 6, 2)->default(0.00);
            $table->float('net_vat', 6, 2)->default(0.00);
            $table->float('service_charge', 6, 2)->default(0.00);
            $table->float('total', 6, 2)->default(0.00);
            $table->date('invoice_date')->nullable();
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
        Schema::dropIfExists('custom_invoices');
    }
}
