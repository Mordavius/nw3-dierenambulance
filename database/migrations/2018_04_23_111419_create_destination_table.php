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
            $table->integer('ticket_id')->nullable();
            $table->integer('known_address_id')->nullable();
            $table->string('postal_code');
            $table->string('address');
            $table->string('house_number');
            $table->string('city');
<<<<<<< HEAD
            $table->string('coordinates');
=======
>>>>>>> 15182f4c7447e578809c1552ae12c0d945574e40
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
