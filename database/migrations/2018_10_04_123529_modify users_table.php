<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            
           $table->dropColumn('name');
            //manual field
            $table->string('username')->unique();
            $table->string('fullname')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('telegram_us')->unique()->nullable();
            $table->string('email')->nullable()->change();
            $table->integer('role_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
