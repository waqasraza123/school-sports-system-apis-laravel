<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentIdToAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
        });

        Schema::table('album', function (Blueprint $table) {
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::table('album', function (Blueprint $table) {
            $table->dropIfExists('album_student_id_foreign');
            $table->dropIfExists('student_id');
        });

        Schema::dropIfExists('students');
    }
}
