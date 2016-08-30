<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLevelIdForRoster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rosters', function (Blueprint $table) {
            $table->dropForeign('rosters_level_id_foreign');
            $table->foreign('level_id')->references('id')->on('levels-rosters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rosters', function (Blueprint $table) {

            $table->foreign('level_id')
                ->references('id')->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade')->update();
        });
    }
}
