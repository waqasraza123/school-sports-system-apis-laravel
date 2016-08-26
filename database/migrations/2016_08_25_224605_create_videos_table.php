<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->date('date')->nullable();
            $table->string('url');
            $table->unsignedInteger('video_id');
            $table->unsignedInteger('video_type');

            /*$table->unsignedInteger('school_id')->nullable();
            $table->unsignedInteger('sport_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('game_id')->nullable();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');*/

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
        Schema::table('videos', function (Blueprint $table){
            $table->dropForeign('videos_school_id_foreign', 'videos_sport_id_foreign',
                '\'videos_student_id_foreign\'', 'videos_game_id_foreign');
            $table->dropColumn('school_id', 'sport_id', 'student_id', 'game_id', 'video_id', 'video_type');
        });

        Schema::drop('videos');
    }
}
