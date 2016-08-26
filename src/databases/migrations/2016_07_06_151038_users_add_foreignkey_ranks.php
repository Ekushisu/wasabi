<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAddForeignkeyRanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wa_users', function ($table) {
            $table->foreign('rank_id')->references('id')->on('wa_ranks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wa_users', function($table) {
            $table->dropForeign('wa_users_rank_id_foreign');
        });
    }
}
