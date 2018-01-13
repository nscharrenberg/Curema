<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('content');
            $table->integer('status_id')->references('id')->on('ticket_statuses');
            $table->integer('priority_id')->references('id')->on('ticket_priorities');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('agent_id')->references('id')->on('admins');
            $table->integer('category_id')->references('id')->on('ticket_categories');
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
        Schema::dropIfExists('tickets');
    }
}
