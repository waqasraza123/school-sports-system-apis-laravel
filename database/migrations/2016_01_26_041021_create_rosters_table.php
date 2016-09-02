<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRostersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rosters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 20);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('rosters');
	}
}