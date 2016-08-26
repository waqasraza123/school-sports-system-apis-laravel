<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSponsorIdFromSchoolsAddForeignToSponsorsOfSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table){
            $table->dropColumn('sponsor_id');
        });

        Schema::table('sponsors', function (Blueprint $table){
            $table->unsignedInteger('school_id');
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
        Schema::table('schools', function (Blueprint $table){
            $table->unsignedInteger('sponsor_id');
        });

        Schema::table('sponsors', function (Blueprint $table){
            $table->dropForeign('sponsors_school_id_foreign');
            $table->dropColumn('school_id');
        });
    }
}
