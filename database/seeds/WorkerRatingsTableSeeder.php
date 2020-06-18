<?php

use Illuminate\Database\Seeder;
use App\WorkerRating;

class WorkerRatingsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('worker_ratings')->insert([
			[
				'service_order_id' => 1,
				'worker_id' => 4,
				'sender_id' => 1,
				'stars' => 3,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 2,
				'worker_id' => 1,
				'sender_id' => 2,
				'stars' => 4,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 3,
				'worker_id' => 1,
				'sender_id' => 4,
				'stars' => 2,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 4,
				'worker_id' => 2,
				'sender_id' => 5,
				'stars' => 3,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 5,
				'worker_id' => 2,
				'sender_id' => 2,
				'stars' => 4,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 6,
				'worker_id' => 3,
				'sender_id' => 7,
				'stars' => 2,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 7,
				'worker_id' => 3,
				'sender_id' => 4,
				'stars' => 3,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 8,
				'worker_id' => 3,
				'sender_id' => 6,
				'stars' => 5,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 9,
				'worker_id' => 4,
				'sender_id' => 6,
				'stars' => 2,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 10,
				'worker_id' => 4,
				'sender_id' => 3,
				'stars' => 3,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 11,
				'worker_id' => 4,
				'sender_id' => 7,
				'stars' => 4,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 12,
				'worker_id' => 5,
				'sender_id' => 3,
				'stars' => 5,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 13,
				'worker_id' => 5,
				'sender_id' => 3,
				'stars' => 5,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 14,
				'worker_id' => 6,
				'sender_id' => 6,
				'stars' => 5,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 15,
				'worker_id' => 6,
				'sender_id' => 4,
				'stars' => 5,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 16,
				'worker_id' => 7,
				'sender_id' => 1,
				'stars' => 3,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 17,
				'worker_id' => 7,
				'sender_id' => 4,
				'stars' => 3,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 18,
				'worker_id' => 7,
				'sender_id' => 1,
				'stars' =>2,
				'comment' => 'Muy amable...'
			],[
				'service_order_id' => 19,
				'worker_id' => 7,
				'sender_id' => 3,
				'stars' => 1,
				'comment' => 'Muy amable...'
			]
		]);

	}
}
