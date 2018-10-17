<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldChatIdToCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function(Blueprint $table){
            
           //$table->dropColumn('name');
            //manual field
            //$table->string('chat_id');
            $table->string('chat_id')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function(Blueprint $table){
            
           //$table->dropColumn('name');
            //manual field
            //$table->string('chat_id');
            $table->dropColumn('chat_id');
            
            
        });
    }
}
