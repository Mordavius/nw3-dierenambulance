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
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('time');
            $table->string('address')->nullable();
            $table->integer('housenumber')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('city')->nullable();
            $table->string('centralist');
            $table->string('reportername')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('animalspecies');
            $table->string('gender');
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
