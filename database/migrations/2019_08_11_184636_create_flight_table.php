<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price', 8, 2); //Format: 999999.99
            $table->integer('airline_id');
            $table->foreign('airline_id')->references('id')->on('airline');
            $table->integer('departure_airport_id');
            $table->foreign('departure_airport_id')->references('id')->on('airport');
            $table->integer('arrival_airport_id');
            $table->foreign('arrival_airport_id')->references('id')->on('airport');
            $table->time('arrival_time');
            $table->time('departure_time');
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
        Schema::dropIfExists('flight');
    }
}
