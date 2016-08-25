<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginToSocialLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->unsignedInteger('school_id')->change();
            $table->unsignedInteger('company_id')->change();
            $table->unsignedInteger('sponsor_id')->change();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropForeign('social_links_school_id_foreign');
            $table->dropForeign('social_links_company_id_foreign');
            $table->dropForeign('social_links_sponsor_id_foreign');
        });
    }
}
