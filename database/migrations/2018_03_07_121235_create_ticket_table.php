<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('destination_id');
            $table->integer('animal_id');
            $table->integer('finance_id')->nullable();
            $table->integer('bus_id')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('address')->nullable();
            $table->string('centralist');
            $table->string('reporter_name')->nullable();
            $table->string('telephone')->nullable();
            $table->string('driver')->nullable();
            $table->string('passenger')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}