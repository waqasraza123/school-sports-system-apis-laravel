<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('games_videos', function (Blueprint $table) {
             $table->engine = 'MyISAM';
             $table->unsignedInteger('games_id')->nullable()->index();
             $table->unsignedInteger('video_id')->nullable()->index();

             $table->foreign('games_id')->references('id')->on('games')->onDelete('cascade');
             $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
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
         Schema::dropIfExists('games_videos');
     }
 }
