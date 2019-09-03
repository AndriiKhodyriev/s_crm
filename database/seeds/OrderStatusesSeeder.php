<?php

use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orderstatuses')->insert([
            'status_name' => 'Новый заказ',
        ]);
        DB::table('orderstatuses')->insert([
            'status_name' => 'В работе',
        ]);
        DB::table('orderstatuses')->insert([
            'status_name' => 'Заказано',
        ]);
        DB::table('orderstatuses')->insert([
            'status_name' => 'Отправленно',
        ]);
        DB::table('orderstatuses')->insert([
            'status_name' => 'Доставлено / Получено',
        ]);
    }
}
