<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUtcOffsetAndAddTimezone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('airport', function (Blueprint $table) {
            $table->dropColumn('utc_offset');
            $table->string('timezone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('airport', function (Blueprint $table) {
            $table->dropColumn('utc_offset');
            $table->string('timezone');
        });
    }
}
