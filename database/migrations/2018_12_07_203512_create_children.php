<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildren extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('profile_id', false, true)->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('class_id', false, true)->nullable();
            $table->foreign('class_id')->references('id')->on('classes');

            $table->integer('photo_id', false, true)->nullable();
            $table->foreign('photo_id')->references('id')->on('photos');

            $table->integer('user_id', false, true)->nullable()->unique();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('children');
    }
}
