<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MessagesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('messages')->insert([
			[
				'job_id' => 1, 
				'user_id' => 1,
				'worker_id' => 4,
				'sender' => 'client', 
				'body' => 'Hola ¿qué tal?'
			],[
				'job_id' => 1, 
				'user_id' => 1,
				'worker_id' => 4,
				'sender' => 'worker', 
				'body' => 'Hola. Bien todo ¿cómo está usted?'
			]
		]);
	}
}
/*
job_id
sender_id
recipient_id
body
 */
