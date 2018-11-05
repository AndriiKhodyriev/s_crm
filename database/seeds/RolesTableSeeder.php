<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'full access',
        ]);
        DB::table('roles')->insert([
            'name' => 'manager',
            'description' => 'almost full access',
        ]);

      	DB::table('roles')->insert([
            'name' => 'operator',
            'description' => 'extended access',
        ]);

        DB::table('roles')->insert([
            'name' => 'grunt',
            'description' => 'restricted access',
        ]);
    }
}
