<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRostersStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rosters_students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->deafult(1);
            $table->unsignedInteger('roster_id')->default(1);

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('roster_id')->references('id')->on('rosters');
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
        Schema::dropIfExists('rosters_students');
    }
}
