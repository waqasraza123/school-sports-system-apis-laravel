<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_games', function(Blueprint $table)
        {
            $table->unsignedInteger('games_id')
                ->nullable()
                ->index();
            $table->foreign('games_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('gallery_id')->nullable()->index();
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('gallery_roster', function(Blueprint $table)
        {
            $table->unsignedInteger('roster_id')
                ->nullable()
                ->index();
            $table->foreign('roster_id')
                ->references('id')
                ->on('rosters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('gallery_id')->nullable()->index();
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('gallery_level', function(Blueprint $table)
        {
            $table->unsignedInteger('level_id')
                ->nullable()
                ->index();
            $table->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('gallery_id')->nullable()->index();
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('gallery_sport', function(Blueprint $table)
        {
            $table->unsignedInteger('sport_id')
                ->nullable()
                ->index();
            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('gallery_id')->nullable()->index();
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
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
        //
    }
}
