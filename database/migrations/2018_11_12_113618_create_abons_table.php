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
            $table->integer('password')->nullable();
            $table->string('tarif_plan')->nullable();
            $table->string('fullname')->nullable();
            $table->string('street')->nullable();
            $table->string('build')->nullable();
            $table->string('flat')->nullable();
            $table->string('phone')->nullable();
            $table->integer('all_money')->nullable();
            $table->integer('leng')->nullable();
            $table->string('base_ip')->nullable();
            $table->string('client_ip')->nullable();
            $table->string('mac_onu')->nullable();
            $table->string('point_inc')->nullable();
            $table->text('comment')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('t_connection_id')->nullable();
            $table->integer('create_user_id')->nullable();
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
