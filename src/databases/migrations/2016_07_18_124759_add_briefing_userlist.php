<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBriefingUserlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('wa_briefings_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('briefing_id')->unsigned();
            $table->integer('status')->unsigned();
          });

          Schema::table('wa_briefings_users', function ($table) {
            $table->foreign('user_id')->references('id')->on('wa_users');
            $table->foreign('briefing_id')->references('id')->on('wa_briefings');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wa_briefings_users');
    }
}
