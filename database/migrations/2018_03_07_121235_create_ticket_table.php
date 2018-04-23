<?php

namespace database\migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->increments('ticket_id');
            $table->integer('destination_id');
            $table->integer('animal_id');
            $table->integer('finance_id');
            $table->date('date');
            $table->time('time');
            $table->string('address')->nullable();
            $table->integer('housenumber')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('city')->nullable();
            $table->string('centralist');
            $table->string('reportername')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('driver');
            $table->string('passenger');
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
        Schema::dropIfExists('ticket');
    }
}
