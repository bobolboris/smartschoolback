<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_parents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('child_id', false, true)->nullable();
            $table->foreign('child_id')->references('id')->on('children');

            $table->integer('parent_id', false, true)->nullable();
            $table->foreign('parent_id')->references('id')->on('parents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children_parents');
    }
}
