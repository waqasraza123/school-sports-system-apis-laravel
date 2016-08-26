<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 225)->nullable();
            $table->string('name', 225)->nullable();
            $table->unsignedInteger('album_id')->nullable()->index('album_id');
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
        Schema::table('gallery', function(Blueprint $table){
            $table->dropIndex('album_id');
            $table->dropForeign('gallery_games_gallery_id_foreign');
            $table->dropColumn('id', 'title', 'name');
        });

        //Schema::drop('gallery');
    }
}
