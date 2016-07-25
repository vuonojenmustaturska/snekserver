<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nation_id');
            $table->integer('era');
            $table->string('name');
            $table->string('epithet');
            $table->string('brief');
            $table->text('description');
            $table->integer('implemented_by')->nullable()->references('id')->on('mods');
            $table->timestamps();
            $table->index('nation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nations');
    }
}
