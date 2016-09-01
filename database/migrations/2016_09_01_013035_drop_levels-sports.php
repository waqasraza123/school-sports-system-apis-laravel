<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLevelsSports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('levels-sports');

        Schema::create('levels-sports', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('sport_id')->nullable();
            $table->unsignedInteger('level_id')->nullable();

            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('level_id')->references('id')->on('levels');
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
    }
}
