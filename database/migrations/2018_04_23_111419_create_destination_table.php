<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bus_id')->nullable();
            $table->integer('ticket_id');
            $table->string('vehicle')->nullable();
            $table->integer('known_address_id')->nullable();
            $table->string('postal_code');
            $table->string('address');
            $table->string('house_number')->nullable();
            $table->string('city');
            $table->string('township');
            $table->string('coordinates')->nullable();
            $table->integer('milage')->nullable();
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
        Schema::dropIfExists('destination');
    }
}
