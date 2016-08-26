<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('wa_opexs', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('periode');
          $table->string('location');
          $table->longText('description');
          $table->longText('thumbnail');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wa_opexs');
    }
}
