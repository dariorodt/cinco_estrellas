<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
				'email' => 'josemartinez@example.com', 
				'rut' => '7818123-0',
				'phone_number' => '564446365555',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('josemartinez')
			],
			[
				'email' => 'victorcontreras@example.com', 
				'rut' => '24585256-8',
				'phone_number' => '564446361346',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('victorcontreras')
			],
			[
				'email' => 'teresamedina@example.com', 
				'rut' => '12211921-1',
				'phone_number' => '564623238855',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('teresamedina')
			],
			[
				'email' => 'miguelcastanos@example.com', 
				'rut' => '10154404-4',
				'phone_number' => '565556354859',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('miguelcastaños')
			],
			[
				'email' => 'gabrielalara@example.com', 
				'rut' => '23701213-5',
				'phone_number' => '569891636688',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('gabrielalara')
			],
			[
				'email' => 'danielarodriguez@example.com', 
				'rut' => '7855855-5',
				'phone_number' => '562323499944',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('danielarodriguez')
			],
			[
				'email' => 'gerardovelez@example.com', 
				'rut' => '22516239-5',
				'phone_number' => '569884897152',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('gerardovelez')
			]
		]);
	}
}