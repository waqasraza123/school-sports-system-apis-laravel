<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTagsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_games', function(Blueprint $table)
        {
            $table->unsignedInteger('games_id')
                ->nullable()
                ->index();
            $table->foreign('games_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('album_id')->nullable()->index();
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('album_level_sport', function(Blueprint $table)
        {
            $table->unsignedInteger('level_sport_id')
                ->nullable()
                ->index();
            $table->foreign('level_sport_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('album_id')->nullable()->index();
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('album_year', function(Blueprint $table)
        {
            $table->unsignedInteger('year_id')
                ->nullable()
                ->index();
            $table->foreign('year_id')
                ->references('id')
                ->on('years')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('album_id')->nullable()->index();
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('album_sport', function(Blueprint $table)
        {
            $table->unsignedInteger('sport_id')
                ->nullable()
                ->index();
            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('album_id')->nullable()->index();
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('album_school', function(Blueprint $table)
        {
            $table->unsignedInteger('school_id')
                ->nullable()
                ->index();
            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('album_id')->nullable()->index();
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
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
        Schema::dropIfExists('album_games');
        Schema::dropIfExists('album_level_sport');
        Schema::dropIfExists('album_year');
        Schema::dropIfExists('album_sport');
        Schema::dropIfExists('album_school');
    }
}
