<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRostersSportsLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels-rosters', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('levels-sports', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('levels-rosters');
        Schema::drop('levels-sports');
    }
}
