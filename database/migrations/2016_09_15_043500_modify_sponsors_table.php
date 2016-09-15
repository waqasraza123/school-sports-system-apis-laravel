<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropColumn('logo', 'logo2', 'color', 'color2', 'color3', 'tagline', 'bio', 'photo',
                'video', 'address', 'url', 'email', 'phone');

            $table->unsignedInteger('ad_id')->nullable();
            $table->foreign('ad_id')->references('id')->on('ads');
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
            //
        });
    }
}
