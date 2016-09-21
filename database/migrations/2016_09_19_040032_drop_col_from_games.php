<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColFromGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $conn = Schema::getConnection();
        $dbSchemaManager = $conn->getDoctrineSchemaManager();
        $doctrineTable = $dbSchemaManager->listTableDetails('games');

        Schema::disableForeignKeyConstraints();

        Schema::table('games', function (Blueprint $table) use ($doctrineTable) {

            // alter table "users" add constraint users_email_unique unique ("email")
            if ($doctrineTable->hasIndex('level_id'))
            {
                $table->dropIndex('level_id');
            }

            if ($doctrineTable->hasIndex('sport_id'))
            {
                $table->dropIndex('sport_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
}
