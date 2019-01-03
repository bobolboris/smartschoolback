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
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic');
            $table->integer('photo_id', false, true)->nullable();

            $table->integer('school_id', false, true)->nullable();
            $table->foreign('school_id')->references('id')->on('schools');

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
