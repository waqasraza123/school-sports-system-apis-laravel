<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateDeleteColumnsForAlbumsPhotosGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add album_id to photos
        Schema::table('photos', function (Blueprint $table){
            $table->unsignedInteger('album_id')->default(2);
            $table->foreign('album_id')->references('id')->on('album');
        });

        //add season id to album
        Schema::table('album', function (Blueprint $table){
            $table->dropForeign('album_sport_id_foreign');
            $table->dropColumn('sport_id');
            $table->unsignedInteger('season_id')->default(1);
            $table->foreign('season_id')->references('id')->on('seasons');
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
