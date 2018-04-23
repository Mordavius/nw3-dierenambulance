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
            $table->increments('ticket_id');
            $table->integer('destination_id');
            $table->integer('animal_id');
            $table->integer('finance_id');
            $table->date('date');
            $table->time('time');
            $table->string('address')->nullable();
            $table->integer('house_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('township')->nullable();
            $table->string('centralist');
            $table->string('reporter_name')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
