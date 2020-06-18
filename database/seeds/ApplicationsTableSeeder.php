<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ApplicationsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('applications')->insert([
		
			[
				'job_id' => 1,
				'worker_id' => 4,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'job_id' => 15,
				'worker_id' => 3,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'job_id' => 12,
				'worker_id' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'job_id' => 3,
				'worker_id' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'job_id' => 15,
				'worker_id' => 5,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'job_id' => 1,
				'worker_id' => 2,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'job_id' => 3,
				'worker_id' => 7,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		
		]);
	}
}


