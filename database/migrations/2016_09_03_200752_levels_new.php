<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LevelsNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels_news', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('news_id');

            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('news_id')->references('id')->on('news');

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
        Schema::dropIfExists('levels_news');
    }
}
