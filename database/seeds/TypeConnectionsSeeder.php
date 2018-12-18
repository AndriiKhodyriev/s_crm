<?php

use Illuminate\Database\Seeder;

class TypeConnectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_connections')->insert([
            'name' => 'PON',
            
        ]);

        DB::table('t_connections')->insert([
            'name' => 'WiFi',
            
        ]);
        
        DB::table('t_connections')->insert([
            'name' => 'Кабель - медь',
            
        ]);
    }
}
