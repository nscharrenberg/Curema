<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcceptedColumnToEstimate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->boolean('accepted')->default(false);
            $table->date('response_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->dropColumn('accepted');
            $table->dropColumn('accepted_date');
        });
    }
}
