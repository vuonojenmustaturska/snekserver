<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {

            $table->integer('hours')->nullable()->change();
            $table->integer('hofsize')->nullable()->change();
            $table->integer('indepstr')->nullable()->change();
            $table->integer('magicsites')->nullable()->change();
            $table->integer('eventrarity')->nullable()->change();
            $table->integer('richness')->nullable()->change();
            $table->integer('resources')->nullable()->change();
            $table->integer('startprov')->nullable()->change();
            $table->integer('scoregraphs')->nullable()->change();
            $table->integer('nonationinfo')->nullable()->change();
            $table->integer('noartrest')->nullable()->change();
            $table->integer('clustered')->nullable()->change();
            $table->integer('requiredap')->nullable()->change();
            $table->integer('lvl1thrones')->nullable()->change();
            $table->integer('lvl2thrones')->nullable()->change();
            $table->integer('lvl3thrones')->nullable()->change();
            $table->integer('totalvp')->nullable()->change();
            $table->integer('capitalvp')->nullable()->change();
            $table->integer('requiredvp')->nullable()->change();
            $table->integer('summervp')->nullable()->change();
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
