<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('name');
            $table->string('number');
            $table->string('photo')->nullable();
            $table->string('position')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pro_flag')->nullable();
            $table->string('pro_cover_photo')->nullable();
            $table->string('pro_head_photo')->nullable();
            $table->unsignedInteger('school_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
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
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_school_id_foreign');
        });

        Schema::dropIfExists('students');
    }

}
