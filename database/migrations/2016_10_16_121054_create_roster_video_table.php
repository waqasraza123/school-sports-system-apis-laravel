<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRosterVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roster_video', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('roster_id')->nullable()->index();
            $table->unsignedInteger('video_id')->nullable()->index();

            $table->foreign('roster_id')->references('id')->on('rosters')->onDelete('cascade');
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
        Schema::dropIfExists('student_video');
    }
}
