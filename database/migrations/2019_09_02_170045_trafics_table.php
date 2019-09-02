<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TraficsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trafics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('b_d_c_o_mall_id');
            $table->string('mac');
            $table->string('interface');
            $table->double('input');
            $table->double('output');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
