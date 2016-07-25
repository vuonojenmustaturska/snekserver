<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModNationsUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nations', function (Blueprint $table) {
            $table->dropUnique('implemented_by');
            $table->unique(['nation_id', 'implemented_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nations', function (Blueprint $table) {
            //
        });
    }
}
