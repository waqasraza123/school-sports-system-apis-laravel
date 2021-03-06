<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schools', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50)->nullable();
			$table->string('short_name', 25)->nullable();
			$table->string('mascot_name', 25)->nullable();
			$table->string('athletics_logo', 50)->nullable();
			$table->string('bio')->nullable();
			$table->string('adress', 100)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 2)->nullable();
			$table->integer('zip')->nullable();
			$table->string('phone', 25)->nullable();
			$table->string('website', 25)->nullable();
			$table->string('video')->nullable();
			$table->string('photo')->nullable();
			$table->text('api_key')->nullable();
			$table->string('livestream_url')->nullable();
			$table->unsignedInteger('league_id')->nullable()->index('league_id');
			$table->unsignedInteger('division_id')->nullable()->index('division_id');
			$table->unsignedInteger('district_id')->nullable()->index('district_id');
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
		Schema::dropIfExists('schools');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
