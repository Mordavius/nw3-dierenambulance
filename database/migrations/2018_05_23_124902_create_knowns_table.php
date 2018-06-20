<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnownsTable extends Migration
{
        /**
         * Run the migrations.
         *
         * @return void
         */
    public function up()
    {
            Schema::create('knowns', function (Blueprint $table) {
                $table->increments('id');
                $table->string('location_name');
                $table->string('postal_code');
                $table->string('address');
                $table->string('house_number');
                $table->string('city');
                $table->string('township');
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
                Schema::dropIfExists('knowns');
            }
}
