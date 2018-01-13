<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->references('id')->on('invoice_items');
            $table->integer('invoice_id')->references('id')->on('invoices');
            $table->decimal('rate');
            $table->string('name');
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
        Schema::dropIfExists('invoice_item_taxes');
    }
}
