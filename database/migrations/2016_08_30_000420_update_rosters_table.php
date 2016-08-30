<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rosters', function (Blueprint $table) {
            $table->integer('pro_free');
            $table->string('pro_flag');
            $table->string('pro_cover_photo');
            $table->string('pro_head_photo');
            $table->unsignedInteger('school_id');
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

        Schema::table('rosters', function (Blueprint $table) {
            $table->dropForeign('rosters_school_id_foreign');
            $table->dropColumn('pro_free', 'pro_flag', 'pro_cover_photo', 'pro_head_photo', 'school_id');
        });
    }
}
