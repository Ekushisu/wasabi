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
        Schema::create('wa_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('banned')->default(0);
            $table->tinyInteger('level')->default(0);
            $table->string('firstName')->default('Jean');
            $table->string('lastName')->default('Dupont');
            $table->integer('rank_id')->unsigned();
            $table->longText('background')->nullable();
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
        Schema::drop('wa_users');
    }
}
