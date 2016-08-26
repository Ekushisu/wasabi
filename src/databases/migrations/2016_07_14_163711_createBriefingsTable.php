<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('wa_briefings', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('opex_id')->unsigned()->nullable();
          $table->string('name');
          $table->string('type');
          $table->text('chapo', 300)->nullable();
          $table->longText('content')->nullable();
          $table->string('thumbnail')->nullable();
          $table->boolean('publiState')->default(1);
          $table->boolean('missionState')->default(0);
          $table->timestamp('missionDate')->nullable();
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
        Schema::drop('wa_briefings');
    }
}
