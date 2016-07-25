<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesAddBools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->boolean('teamgame')->default(FALSE);
            $table->boolean('noartrest')->default(FALSE);
            $table->boolean('clustered')->default(FALSE);
            $table->boolean('scoregraphs')->default(FALSE);
            $table->boolean('nonationinfo')->default(FALSE);
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
