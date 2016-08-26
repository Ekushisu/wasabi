<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('wa_notes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('category_id')->unsigned()->nullable();
          $table->integer('author_id')->unsigned()->nullable();
          $table->string('name');
          $table->text('chapo', 300)->nullable();
          $table->longText('content')->nullable();
          $table->string('thumbnail')->nullable();
          $table->boolean('publiState')->default(1);
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
        Schema::drop('wa_notes');
    }
}
