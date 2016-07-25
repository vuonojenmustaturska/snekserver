<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signups', function (Blueprint $table) {
        	$table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('lobby_id')->unsigned()->index();
            $table->foreign('lobby_id')->references('id')->on('lobbies')->onDelete('cascade');
            $table->integer('nation_id')->index();
            $table->unique(['user_id', 'lobby_id']);
            $table->unique(['nation_id', 'lobby_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('signups');
    }
}
