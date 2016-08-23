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
			$table->integer('id', true);
			$table->integer('sport_id')->nullable()->index('sport_id');
			$table->integer('level_id')->nullable()->index('level_id');
			$table->integer('year_id')->nullable()->index('year_id');
			$table->integer('position')->nullable()->index('position');
			$table->string('first_name', 20)->nullable();
			$table->string('last_name', 20)->nullable();
			$table->string('jersey', 5)->nullable();
			$table->integer('height_feet')->nullable();
			$table->integer('height_inches')->nullable();
			$table->integer('weight')->nullable();
			$table->string('hometown', 50)->nullable();
			$table->integer('years_at_sfc')->nullable();
			$table->string('verse', 25)->nullable();
			$table->string('food', 25)->nullable();
			$table->string('photo', 50)->nullable();
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
		Schema::drop('rosters');
	}

}
