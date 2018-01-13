<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->references('id')->on('clients');
            $table->integer('contact_id')->references('id')->on('users');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('notes');
            $table->integer('staff_id')->references('id')->on('admin');
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
        Schema::dropIfExists('client_contacts');
    }
}
