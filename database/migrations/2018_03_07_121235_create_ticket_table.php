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
	        $table->integer('bus_id')->unsigned()->nullable();
	        $table->foreign('bus_id')->references('id')->on('buses');
            $table->date('date');
            $table->time('time');
            $table->string('centralist');
            $table->string('reporter_name')->nullable();
            $table->string('telephone')->nullable();
            $table->tinyInteger('finished')->default('0')->length('1');
            $table->integer('priority');
            $table->integer('payment_invoice')->nullable();
            $table->integer('payment_gift')->nullable();
            $table->string('payment_method')->nullable();
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
