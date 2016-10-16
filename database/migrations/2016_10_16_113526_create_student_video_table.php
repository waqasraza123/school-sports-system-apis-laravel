<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_video', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('student_id')->nullable()->index();
            $table->unsignedInteger('video_id')->nullable()->index();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
