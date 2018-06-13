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
            $table->integer('finance_id')->nullable();
            $table->integer('animal_id');
            $table->integer('bus_id')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('centralist');
            $table->string('reporter_name')->nullable();
            $table->string('telephone')->nullable();
            $table->string('driver')->nullable();
            $table->string('passenger')->nullable();
            $table->tinyInteger('finished')->default('0')->length('1');
            $table->integer('priority');
            $table->timestamps();
            // finance tables
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
