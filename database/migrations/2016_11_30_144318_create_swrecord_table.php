<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwrecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swrecord', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sw_assetid');//not fk cuz its not unique
            $table->string('hw_assetid'); //install location
            $table->string('current_userid');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swrecord');
    }
}
