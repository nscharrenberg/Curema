<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->references('id')->on('contract_types');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('client_id')->references('id')->on('clients');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('sales_agent')->references('id')->on('admins');
            $table->integer('currency_id')->references('id')->on('currencies');
            $table->decimal('value');
            $table->boolean('showToClient')->default(true);
            $table->boolean('accepted')->default(false);
            $table->date('response_date')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
