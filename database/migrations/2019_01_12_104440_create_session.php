<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sms_code');
            $table->string('token', 512);
            $table->integer('expire_sms_code', false, true);
            $table->timestamps();
            $table->string('ip', 17)->nullable();
            $table->string('os')->nullable();
            $table->string('browser')->nullable();

            $table->integer('user_id', false, true)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session');
    }
}
