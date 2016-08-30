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
			$table->unsignedInteger('sport_id')->nullable()->index('sport_id');
			$table->unsignedInteger('level_id')->nullable()->index('level_id');
			$table->unsignedInteger('position')->nullable()->index('position');
			$table->string('name', 20)->nullable();
			$table->integer('height_feet')->nullable();
			$table->integer('height_inches')->nullable();
			$table->integer('weight')->nullable();
			$table->string('photo', 50)->nullable();
			$table->string('number', 50)->nullable();
			$table->integer('academic_year')->nullable();
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