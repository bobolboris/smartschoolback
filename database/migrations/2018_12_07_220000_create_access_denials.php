<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessDenials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_denials', function (Blueprint $table) {
            $table->increments('id');
            $table->time('time');
            $table->date('date');
            $table->tinyInteger('direction', false, true);
            $table->tinyInteger('cause', false, true);

            $table->integer('key_id', false, true)->nullable();
            $table->foreign('key_id')->references('id')->on('children_keys');

            $table->integer('access_point_id', false, true)->nullable();
            $table->foreign('access_point_id')->references('id')->on('access_points');

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
        Schema::dropIfExists('access_denials');
    }
}
