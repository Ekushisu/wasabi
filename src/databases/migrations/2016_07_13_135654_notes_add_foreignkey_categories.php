<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotesAddForeignkeyCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wa_notes', function ($table) {
          $table->foreign('category_id')->references('id')->on('wa_categories');
          $table->foreign('author_id')->references('id')->on('wa_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wa_notes', function($table) {
            $table->dropForeign('wa_notes_category_id_foreign');
            $table->dropForeign('wa_notes_author_id_foreign');
        });
    }
}
