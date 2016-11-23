<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sw_assetid');
            $table->string('sw_serialno');
            $table->string('sw_po_no');
            $table->date('sw_date_po');
            $table->string('sw_model');
            $table->string('sw_type');
            $table->float('sw_price');
            $table->string('sw_prodkey');
            $table->integer('sw_supplier')->unsigned();
            $table->foreign('sw_supplier')->references('id')->on('supplier')->onDelete('cascade')->onUpdate('cascade');
            $table->date('sw_datesupp');
            $table->date('sw_datefac');
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
        Schema::dropIfExists('software');
    }
}
