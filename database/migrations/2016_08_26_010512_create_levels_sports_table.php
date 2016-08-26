<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels_sports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('level_id')->nullable();
            $table->unsignedInteger('sport_id')->nullable();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('sport_id')->references('id')->on('sports');
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
        Schema::drop('levels_sports');
    }
}
