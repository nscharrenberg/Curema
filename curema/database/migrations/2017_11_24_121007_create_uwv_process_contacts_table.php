<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUwvProcessContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uwv_process_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('process_id')->references('id')->on('uwv_processes');
            $table->integer('contact_id')->references('id')->on('uwv_contacts');
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
        Schema::dropIfExists('uwv_process_contacts');
    }
}
