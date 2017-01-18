<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamestatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamestats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->references('id')->on('games');
            $table->integer('turn');
            $table->integer('nation_id')->references('id')->on('nations');
            $table->integer('provinces');
            $table->integer('forts');
            $table->integer('income');
            $table->integer('gemincome');
            $table->integer('dominion');
            $table->integer('armysize');
            $table->integer('victorypoints');
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
        Schema::drop('gamestats');
    }
}
