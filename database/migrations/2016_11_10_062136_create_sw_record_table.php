<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sw_record', function (Blueprint $table) {
            $table->increments('rec_id');
            // $table->date('entry_date');
            // $table->string('fk_assetid');
            // $table->foreign('fk_assetid')->references('hw_assetid')->on('hardwares');
            // $table->string('rec_remark');
            // $table->string('rec_status');
            // $table->varchar('current_userid');
            // $table->foreign('current_userid')->references('staff_id')->on('staff');
            // $table->integer('prev_rec_id'); /* refers to rec_id of the previous owner */
            // $table->integer('rec_count');
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
        Schema::dropIfExists('sw_record');
    }
}
