<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function(Blueprint $table)
        {

            $table->foreign('sport_id')
                ->references('id')->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('level_id')
                ->references('id')->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('opponents_id')
                ->references('id')->on('schools')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('locations_id')
                ->references('id')->on('locations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('rosters', function(Blueprint $table)
        {
            $table->foreign('sport_id')
                ->references('id')->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('level_id')
                ->references('id')->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('position')
                ->references('id')->on('positions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('schools', function(Blueprint $table)
        {
            $table->foreign('league_id')
                ->references('id')->on('leagues')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('division_id')
                ->references('id')->on('divisions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('district_id')
                ->references('id')->on('districts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('positions', function(Blueprint $table)
        {
            $table->foreign('sport_id')
                ->references('id')->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
