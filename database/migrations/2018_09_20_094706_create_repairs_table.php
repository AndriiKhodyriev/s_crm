<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function($table){
            
            $table->increments('id');
            //manual field
            $table->string('login');
            $table->text('street');
            $table->string('build');
            $table->string('phone_num');
            $table->string('vlan_name');
            $table->text('cause');
            $table->text('comment')->nullable();
            //date 
            $table->timestamps();
            //keys 
            $table->integer('city_id')->nullable();
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
        Schema::dropIfExists('repairs');
    }
}
