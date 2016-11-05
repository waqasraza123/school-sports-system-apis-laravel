<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempRosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_roster', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roster_id')->nullable()->unsigned();
          /**    $table->foreign('roster_id')->references('id')->on('rosters');  UNNEEDED    */
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
        Schema::drop('temp_roster');
    }
}
