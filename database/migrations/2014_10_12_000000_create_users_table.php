<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name',120);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->date('birthday')->default(date("Y-m-d H:i:s"));
            $table->boolean('gender')->default(0);
            $table->string('address')->default('');
            $table->char('skype_id',120)->default('');
            $table->char('phone',20)->default('');
            $table->string('facebook_id')->default('');
            $table->unsignedSmallInteger('role_id')->default(1); //student
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
        Schema::dropIfExists('users');
    }
}
