<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::disableForeignKeyConstraints();
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->integer('height_feet');
            $table->integer('height_inches');
            $table->integer('academic_year');
            $table->integer('pro_free');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('height');
            $table->dropIfExists('height_feet');
            $table->dropIfExists('height_inches');
            $table->dropIfExists('academic_year');
            $table->dropIfExists('pro_free');
        });
    }
}
