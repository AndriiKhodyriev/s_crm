<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login');
            $table->integer('password');
            $table->string('tarif_plan');
            $table->string('fullname');
            $table->string('address');
            $table->string('phone');
            $table->integer('all_money');
            $table->integer('leng')->nullable();
            $table->string('base_ip')->nullable();
            $table->string('client_ip')->nullable();
            $table->string('mac_onu')->nullable();
            $table->string('point_inc')->nullable();
            $table->text('comment')->nullable();
            $table->integer('city_id');
            $table->integer('t_connection_id');
            $table->integer('create_user_id');
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
        Schema::dropIfExists('abons');
    }
}
