<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_id'); /* xbuat PK sebab ade field yg xde staff ID */
            $table->string('staff_name');
            $table->string('staff_mail');
            $table->string('staff_mobile');
            $table->string('staff_telno');
            $table->string('staff_title');
            $table->string('staff_dept');
            $table->string('staff_company');
            $table->string('staff_officeLocation');
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
        Schema::dropIfExists('staff');
    }
}
