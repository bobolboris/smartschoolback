<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('type', false, true);

            $table->integer('profile_id', false, true)->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('user_id', false, true)->nullable()->unique();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('admins');
    }
}
