<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_news', function(Blueprint $table)
        {
            $table->unsignedInteger('games_id')
                ->nullable()
                ->index();
            $table->foreign('games_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('news_id')->nullable()->index();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('news_roster', function(Blueprint $table)
        {
            $table->unsignedInteger('roster_id')
                ->nullable()
                ->index();
            $table->foreign('roster_id')
                ->references('id')
                ->on('rosters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('news_id')->nullable()->index();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('level_news', function(Blueprint $table)
        {
            $table->unsignedInteger('level_id')
                ->nullable()
                ->index();
            $table->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('news_id')->nullable()->index();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('news_sport', function(Blueprint $table)
        {
            $table->unsignedInteger('sport_id')
                ->nullable()
                ->index();
            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('news_id')->nullable()->index();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
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
        Schema::drop('games_news');
        Schema::drop('news_rosters');
        Schema::drop('levels_news');
        Schema::drop('news_sports');
    }
}
