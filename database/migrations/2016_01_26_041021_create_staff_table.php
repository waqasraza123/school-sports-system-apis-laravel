<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seasons', function (Blueprint $table){
			$table->increments('id');
			$table->timestamps();
            $table->string('name');
		});

		Schema::create('staff', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('title', 50)->nullable();
			$table->string('photo', 50)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('phone', 50)->nullable();
			$table->string('website', 50)->nullable();
			$table->string('description')->nullable();
			$table->unsignedInteger('school_id')->nullable();
			$table->foreign('school_id')->references('id')->on('schools');
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
		Schema::drop('staff');
	}

}
