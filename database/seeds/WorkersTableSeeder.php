<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
	
	// http://jqueryrut.sourceforge.net/generador-de-ruts-chilenos-validos.html
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('workers')->insert([
			[
				'rut' => '24696786-5', 
				'email' => 'ismaelsalazar@example.com', 
				'phone_number' => '563324596658',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('ismaelsalazar')
			],
			[
				'rut' => '7134060-0', 
				'email' => 'patriciatoledo@example.com', 
				'phone_number' => '568489658896',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('patriciatoledo')
			],
			[
				'rut' => '8535283-0', 
				'email' => 'fernandoquevedo@example.com', 
				'phone_number' => '563325669191',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('fernandoquevedo')
			],
			[
				'rut' => '16659093-0', 
				'email' => 'estefaniaperez@example.com', 
				'phone_number' => '584129490074',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('estefaniaperez')
			],
			[
				'rut' => '10034122-0', 
				'email' => 'lisandrogomez@example.com', 
				'phone_number' => '563228286495',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('lisandrogomez')
			],
			[
				'rut' => '21431065-1', 
				'email' => 'marieladiamante@example.com', 
				'phone_number' => '568559658485',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('marieladiamante')
			],
			[
				'rut' => '12228912-5', 
				'email' => 'sofiaherradez@example.com', 
				'phone_number' => '563224515566',
				'email_verified_at' => Carbon::now(), 
				'password' => Hash::make('sofiaherradez')
			]
		]);
	}
}
