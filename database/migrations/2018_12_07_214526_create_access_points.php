<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('zonea', false, true)->nullable();
            $table->integer('zoneb', false, true)->nullable();

            $table->integer('school_id', false, true)->nullable();
            $table->foreign('school_id')->references('id')->on('schools');

            $table->integer('system_id', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_points');
    }
}
