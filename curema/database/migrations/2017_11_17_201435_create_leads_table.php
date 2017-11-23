<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('phonenumber')->nullable();
            $table->integer('country_id')->references('id')->on('countries')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('assigned_to')->references('id')->on('admins');
            $table->integer('added_by')->references('id')->on('admins');
            $table->integer('status_id');
            $table->integer('source_id')->references('id')->on('lead_sources');
            $table->dateTime('last_contact')->nullable();
            $table->dateTime('last_status_change')->nullable();
            $table->boolean('lost_lead')->default(0);
            $table->boolean('public')->default(0);
            $table->integer('default_language')->references('id')->on('languages');
            $table->integer('client_id')->references('id')->on('clients')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
