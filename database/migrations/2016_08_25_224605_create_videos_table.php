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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('videos', function (Blueprint $table){
            $table->dropIfExists('videos_school_id_foreign', 'videos_sport_id_foreign',
                '\'videos_student_id_foreign\'', 'videos_game_id_foreign');
            $table->dropIfExists('school_id', 'sport_id', 'student_id', 'game_id', 'video_id', 'video_type');
        });

        Schema::dropIfExists('videos');
    }
}
