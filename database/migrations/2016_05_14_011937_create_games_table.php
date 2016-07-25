<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('port');
            $table->string('masterpw');
            $table->string('map');
            $table->integer('era');
            $table->integer('hours');
            $table->integer('hofsize');
            $table->integer('indepstr');
            $table->integer('magicsites');
            $table->integer('eventrarity');
            $table->integer('richness');
            $table->integer('resources');
            $table->integer('startprov');
            $table->integer('scoregraphs');
            $table->integer('nonationinfo');
            $table->integer('noartrest');
            $table->integer('teamgame');
            $table->integer('clustered');
            $table->integer('victorycond');
            $table->integer('requiredap');
            $table->integer('lvl1thrones');
            $table->integer('lvl2thrones');
            $table->integer('lvl3thrones');
            $table->integer('totalvp');
            $table->integer('capitalvp');
            $table->integer('requiredvp');
            $table->integer('summervp');
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
        Schema::drop('games');
    }
}
