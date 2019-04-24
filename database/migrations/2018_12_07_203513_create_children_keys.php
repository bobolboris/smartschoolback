<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateChildrenKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_codekey', 10)->unique();
            $table->dateTime('codekeytime');
            $table->dateTime('expires')->nullable();
            $table->tinyInteger('status');
            $table->integer('child_id', false, true)->nullable();
            $table->foreign('child_id')->references('id')->on('children');
        });
        DB::statement('ALTER TABLE `children_keys` ADD `codekey` VARBINARY(8) AFTER id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `children_keys` DROP COLUMN `codekey`');
        Schema::dropIfExists('children_keys');
    }
}
