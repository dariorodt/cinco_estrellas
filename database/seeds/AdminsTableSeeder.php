<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('admins')->insert([
			[
				'role_id' => 1,
				'name' => 'SuperAdmin',
				'email' => 'superadmin@cincoestrellas.cl',
				'email_verified_at' => Carbon::now(),
				'password' => Hash::make('superadmin')
			],
		]);
		
		DB::table('admin_profiles')->insert([
			[
				'admin_id' => 1,
				'state' => 'active',
				'name' => 'Super Admin',
				'image' => 'images/super-admin.jpg',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);
	}
}
