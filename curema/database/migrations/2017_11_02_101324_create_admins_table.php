<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phonenumber');
            $table->mediumText('facebook')->nullable();
            $table->mediumText('linkedin')->nullable();
            $table->string('skype')->nullable();
            $table->integer('admin')->default(0);
            $table->integer('is_not_staff')->default(0);
            $table->integer('role')->nullable();
            $table->string('default_language')->default('english');
            $table->boolean('active')->default(true);
            $table->string('media_path_slug')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('direction')->nullable();
            $table->decimal('hourly_rate')->default(0.00);
            $table->text('email_signature')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
