<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


/*
 * Все поля в этой таблицы (кроме user_id и id) должны иметь значения по умолчанию
 *
 */

class CreateSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('value');
            $table->integer('user_id', false, true)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
//            $table->tinyInteger('notification_of_access', false, true)->default(1);
//            $table->tinyInteger('notification_of_access_telegram', false, true)->default(1);
//            $table->text('telegram_chat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
