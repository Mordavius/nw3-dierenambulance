<?php

namespace database\migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuschangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buschanges', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date');
            $table->string('bus');
            $table->string('from');
            $table->string('to');
            $table->integer('kilometerstraveled');
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
        Schema::dropIfExists('buschanges');
    }
}
