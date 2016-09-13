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

        Schema::create('album_roster', function(Blueprint $table)
        {
            $table->unsignedInteger('roster_id')
                ->nullable()
                ->index();
            $table->foreign('roster_id')
                ->references('id')
                ->on('rosters')
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

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_games');
        Schema::dropIfExists('album_roster');
        Schema::dropIfExists('album_year');
    }
}
