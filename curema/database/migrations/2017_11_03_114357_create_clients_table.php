<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->string('vat')->nullable();
            $table->string('phonenumber')->nullable();
            $table->integer('country_id')->references('id')->on('countries');
            $table->string('city');
            $table->string('zipcode');
            $table->string('state');
            $table->string('address');
            $table->string('website')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('lead_id')->nullable();
            $table->integer('billing_country_id')->references('id')->on('countries')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_zipcode')->nullable();
            $table->integer('shipping_country_id')->references('id')->on('countries')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('default_language')->default('english');
            $table->integer('currency_id');
            $table->integer('primary_contact_id')->references('id')->on('users')->default(0);
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
        Schema::dropIfExists('clients');
    }
}
