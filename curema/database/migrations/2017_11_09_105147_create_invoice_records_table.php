<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->references('id')->on('invoices');
            $table->decimal('amount');
            $table->string('payment_type_id')->references('id')->on('payment_types');
            $table->date('date');
            $table->text('note');
            $table->text('transactionReference')->nullable();
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
        Schema::dropIfExists('invoice_records');
    }
}
