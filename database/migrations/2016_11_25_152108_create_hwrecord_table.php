<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHwrecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwrecord', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fk_assetid'); //not fk cuz its not unique (54 duplicates)
            $table->string('remark');
            $table->string('status');
            $table->string('current_userid');
            $table->foreign('current_userid')->references('staff_id')->on('staff');
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
        Schema::dropIfExists('hwrecord');
    }
}
