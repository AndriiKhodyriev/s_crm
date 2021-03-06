<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TicketStatusesTableSeeder::class);
        $this->call(TypeConnectionsSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(OrderStatusesSeeder::class);
    }
}
