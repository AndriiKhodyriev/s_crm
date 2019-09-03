<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'currencie_abriviature' => 'UAH',
        ]);
        DB::table('currencies')->insert([
            'currencie_abriviature' => 'USD',
        ]);
    }
}
