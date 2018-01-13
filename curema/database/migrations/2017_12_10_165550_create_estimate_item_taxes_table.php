<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimateItemTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_item_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->references('id')->on('estimate_items');
            $table->integer('estimate_id')->references('id')->on('estimates');
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
        Schema::dropIfExists('estimate_item_taxes');
    }
}
