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
        	['name' => 'SuperAdmin', 'access_level' => 29],
        	['name' => 'Admin', 'access_level' => 28],
        	['name' => 'Supporter', 'access_level' => 12],
        	['name' => 'Operator', 'access_level' => 11],
            ['name' => 'Finanzas', 'access_level' => 21],
        ]);
    }
}
