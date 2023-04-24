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
            $table->string('cat_id');
            $table->string('caretaker_id');
            $table->string('appointment_type')->nullable();
            $table->string('appointment_id')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('amount')->nullable();
            $table->string('vat')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('paid')->nullable();
            $table->string('balance')->nullable();
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
