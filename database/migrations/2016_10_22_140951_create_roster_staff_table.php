<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRosterStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roster_staff', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('roster_id')->nullable()->index();
            $table->unsignedInteger('staff_id')->nullable()->index();

            $table->foreign('roster_id')->references('id')->on('rosters')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
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
        //
    }
}
