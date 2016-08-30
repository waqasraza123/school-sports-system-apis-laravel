<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 225)->nullable();
            $table->string('image', 50)->nullable();
            $table->string('author', 50)->nullable();
            $table->date('news_date')->nullable();
            $table->string('category', 50)->nullable();
            $table->string('intro', 50)->nullable();
            $table->string('content', 4500)->nullable();
            $table->string('link', 125)->nullable();
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
        Schema::dropIfExists('news');
    }
}
