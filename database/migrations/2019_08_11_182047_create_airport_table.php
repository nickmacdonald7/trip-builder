<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('airline_id');
            $table->foreign('airline_id')->references('id')->on('airline');
            $table->string('code'); //IATA Airport code
            $table->string('name'); //Airport full name
            $table->string('city'); //Airport city
            $table->string('city_code'); //IATA Airport City code, may differ from airport code
            $table->decimal('latitude', 9, 6); //Format: 000.000000
            $table->decimal('longitude', 9, 6); //Format: 000.000000
            $table->integer('utc_offset'); //UTC offset of timezone
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
        Schema::dropIfExists('airport');
    }
}
