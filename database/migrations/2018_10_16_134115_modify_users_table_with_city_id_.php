<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTableWithCityId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            
           //$table->dropColumn('name');
            //manual field
            $table->string('role_id');
            $table->string('city_id')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('users', function(Blueprint $table){
            
           //$table->dropColumn('name');
            //manual field
            $table->dropColumn('role_id');
            $table->dropColumn('city_id');
            
            
        });

    }
}
