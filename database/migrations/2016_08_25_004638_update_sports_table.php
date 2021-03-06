<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sports', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->string('record')->nullable();
            $table->string('highlight_video');
            $table->unsignedInteger('school_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools');
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
        Schema::table('sports', function (Blueprint $table) {
            $table->dropColumn('photo', 'record');
        });
    }
}
