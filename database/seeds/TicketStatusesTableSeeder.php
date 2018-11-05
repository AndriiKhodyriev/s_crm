<?php

use Illuminate\Database\Seeder;

class TicketStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_statuses')->insert([
            'name' => 'Новая',
            
        ]);

        DB::table('ticket_statuses')->insert([
            'name' => 'В Работе',
            
        ]);
        
        DB::table('ticket_statuses')->insert([
            'name' => 'Закрыта',
            
        ]);

        DB::table('ticket_statuses')->insert([
            'name' => 'СРОЧНО',
            
        ]);

    }
}
