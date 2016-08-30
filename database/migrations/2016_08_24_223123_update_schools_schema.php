<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSchoolsSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('athletics_logo');
            $table->dropColumn('mascot_name');

            //add columns
            $table->string('app_name')->nullable();
            $table->string('school_logo')->nullable();
            $table->string('school_color')->nullable();
            $table->string('school_color2')->nullable();
            $table->string('school_color3')->nullable();
            $table->integer('sport_id')->nullable();
            $table->integer('sponsor_id')->nullable();
            $table->integer('staff_id')->nullable();
            $table->string('school_tagline')->nullable();
            $table->string('school_email')->nullable();
            $table->integer('level_id')->nullable();
            $table->integer('news_id')->nullable();
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
        Schema::table('schools', function (Blueprint $table) {
            $table->string('athletics_logo');
            $table->string('mascot_name');

            //add columns
            $table->dropColumn('app_name');
            $table->dropColumn('school_logo');
            $table->dropColumn('school_color');
            $table->dropColumn('school_color2');
            $table->dropColumn('school_color3');
            $table->dropColumn('sport_id');
            $table->dropColumn('sponsor_id');
            $table->dropColumn('staff_id');
            $table->dropColumn('school_tagline');
            $table->dropColumn('school_email');
            $table->dropColumn('level_id');
            $table->dropColumn('news_id');
        });
    }
}
