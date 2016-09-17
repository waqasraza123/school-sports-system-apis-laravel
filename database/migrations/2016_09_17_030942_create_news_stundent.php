<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsStundent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_student', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('news_id')->references('id')->on('news');
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
        Schema::dropIfExists('news_student');
    }
}
