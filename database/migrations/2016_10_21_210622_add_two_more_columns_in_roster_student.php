<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoMoreColumnsInRosterStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rosters_students', function (Blueprint $table) {
            //
            $table->string('jersy')->nullable()->after('roster_id');
            $table->string('photo')->nullable()->after('updated_at');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rosters_students', function (Blueprint $table) {
            //
        });
    }
}
