<?php

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
            $table->string('fname');
            $table->string('lname');
            $table->integer('department');
            $table->integer('year');
            $table->integer('gender');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->date('dob')->nullable();
            $table->string('password');
            $table->string('displaypic')->default("profile_pic/default.png");

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
        Schema::drop('users');
    }
}
