<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHardwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hw_assetid');
            $table->string('hw_serialno');
            $table->string('hw_model');
            $table->string('hw_po_no');
            $table->date('hw_date_po');
            $table->integer('hw_supplier')->unsigned();
            $table->foreign('hw_supplier')->references('id')->on('supplier')->onDelete('cascade')->onUpdate('cascade');
            $table->string('hw_part_no');
            $table->float('hw_price');
            $table->string('hw_type');
            $table->date('hw_datesupp');
            $table->date('hw_datefac');
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
        Schema::dropIfExists('hardware');
    }
}
