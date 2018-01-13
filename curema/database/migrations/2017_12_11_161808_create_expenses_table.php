<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('expenses_categories');
            $table->string('name');
            $table->text('note');
            $table->integer('number')->default(0);
            $table->string('prefix')->nullable();
            $table->decimal('amount')->default(0.00);
            $table->decimal('tax_percentage')->default(0.00);
            $table->integer('currency_id')->references('id')->on('currencies');
            $table->integer('client_id')->references('id')->on('clients')->nullable();
            $table->integer('invoice_id')->references('id')->on('invoices')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('expenses');
    }
}
