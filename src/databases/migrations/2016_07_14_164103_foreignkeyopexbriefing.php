<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foreignkeyopexbriefing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wa_briefings', function ($table) {
          $table->foreign('opex_id')->references('id')->on('wa_opexs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wa_briefings', function($table) {
            $table->dropForeign('wa_briefings_opex_id_foreign');
        });
    }
}
