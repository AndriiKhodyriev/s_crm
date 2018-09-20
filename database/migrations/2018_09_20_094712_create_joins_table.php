<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joins', function($table){
            $table->increments('id');
            $table->text('street');
            $table->string('build');
            $table->text('full_name');
            $table->string('phone_num');
            $table->text('comment')->nullable();
            $table->text('join_area')->nullable();
            $table->text('cable_length')->nullable();
            //date 
            $table->timestamp('date_open');
            $table->timestamp('date_close')->nullable();
            //keys 
            $table->integer('object_id')->nullable();
            $table->integer('ticket_status_id')->nullable();
            $table->integer('create_user_id')->nullable();
            $table->integer('close_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joins');
    }
}
