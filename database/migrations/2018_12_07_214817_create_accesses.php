<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->time('time');
            $table->date('date');
            $table->tinyInteger('direction', false, true);
            $table->tinyInteger('cause', false, true);

            $table->integer('child_id', false, true)->nullable();
            $table->foreign('child_id')->references('id')->on('children');

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
        Schema::dropIfExists('accesses');
    }
}
