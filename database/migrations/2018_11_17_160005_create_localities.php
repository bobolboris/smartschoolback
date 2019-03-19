<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Types
         * 0 - Страна
         * 1 - Город
         * 2 - Район
         * */
        Schema::create('localities', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type', false, true);
            $table->string('name');

            $table->integer('locality_id', false, true)->nullable();
            $table->foreign('locality_id')->references('id')->on('localities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localities');
    }
}
