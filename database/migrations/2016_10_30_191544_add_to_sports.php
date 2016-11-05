<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToSports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('sports', function (Blueprint $table) {
    //
    $table->string('video_cover')->nullable();
    $table->string('video_title')->nullable();
    $table->integer('sort_order')->nullable();

});
    }

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::table('rosters_students', function (Blueprint $table) {
        //
    });
}
}
