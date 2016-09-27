<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSponsorsColumnBack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->string('logo2')->nullable();
            $table->string('color')->nullable();
            $table->string('color2')->nullable();
            $table->string('color3')->nullable();
            $table->string('tagline')->nullable();
            $table->string('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('video')->nullable();
            $table->string('address')->nullable();
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropColumn('logo', 'logo2', 'color', 'color2', 'color3', 'tagline', 'bio', 'photo', 'video', 'address',
            'url', 'email', 'phone');
        });
    }
}
