<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUwvProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uwv_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ordernr')->nullable();
            $table->integer('uwv_service_id')->references('id')->on('uwv_services');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('client_id')->references('id')->on('users');
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
        Schema::dropIfExists('uwv_processes');
    }
}
