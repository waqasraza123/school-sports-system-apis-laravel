<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('school_id')->nullable()->index('school_id');
			$table->unsignedInteger('sport_id')->nullable()->index('sport_id');
			$table->unsignedInteger('level_id')->nullable()->index('level_id');
			$table->unsignedInteger('opponents_id')->nullable()->index('opponents_id');
			$table->unsignedInteger('locations_id')->nullable()->index('locations_id');
			$table->unsignedInteger('year_id')->nullable()->index('year_id');
			$table->timestamp('game_date')->nullable();
			$table->time('game_time')->nullable();
			$table->string('home_away', 15)->nullable();
			$table->string('game_preview')->nullable();
			$table->string('game_recap')->nullable();
			$table->string('video', 25)->nullable();
			$table->string('photo', 25)->nullable();
			$table->string('opponent_roster', 25)->nullable();
			$table->integer('our_score')->nullable();
			$table->integer('opponents_score')->nullable();
			$table->string('result')->nullable();
			$table->string('map_url')->nullable();
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
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('games');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
