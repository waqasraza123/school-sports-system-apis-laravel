<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_school', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id')->nullable();
            $table->unsignedInteger('news_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
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
        Schema::table('news_school', function (Blueprint $table) {
            $table->dropForeign('news_school_school_id_foreign', 'news_school_news_id_foreign');
        });
        Schema::dropIfExists('news_school');
    }
}
