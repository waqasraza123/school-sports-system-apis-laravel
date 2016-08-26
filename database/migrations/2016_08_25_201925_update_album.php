<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('album', function (Blueprint $table) {
            $table->string('url');
            $table->date('date');
            $table->unsignedInteger('school_id')->nullable();
            $table->unsignedInteger('sport_id')->nullable();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('album', function (Blueprint $table) {
            $table->dropForeign('album_school_id_foreign', 'album_sport_id_foreign');
            $table->dropColumn('url', 'date', 'school_id', 'sport_id');
        });
    }
}
