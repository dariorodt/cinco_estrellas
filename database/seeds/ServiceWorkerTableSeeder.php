<?php

use Illuminate\Database\Seeder;

class ServiceWorkerTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('service_worker')->insert([
			[
				'service_id' => 5,
				'worker_id' => 1,
				'visit_required' => 0,
				'day_cost' => 110.00,
				'night_cost' => 180.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 8,
				'worker_id' => 1,
				'visit_required' => 0,
				'day_cost' => 120.00,
				'night_cost' => 200.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 2,
				'worker_id' => 2,
				'visit_required' => 1,
				'day_cost' => 150.00,
				'night_cost' => 230.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 3,
				'worker_id' => 2,
				'visit_required' => 1,
				'day_cost' => 150.00,
				'night_cost' => 230.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 4,
				'worker_id' => 3,
				'visit_required' => 1,
				'day_cost' => 120.00,
				'night_cost' => 200.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 6,
				'worker_id' => 3,
				'visit_required' => 1,
				'day_cost' => 110.00,
				'night_cost' => 180.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 2,
				'worker_id' => 4,
				'visit_required' => 1,
				'day_cost' => 110.00,
				'night_cost' => 180.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 3,
				'worker_id' => 4,
				'visit_required' => 1,
				'day_cost' => 150.00,
				'night_cost' => 230.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 8,
				'worker_id' => 4,
				'visit_required' => 0,
				'day_cost' => 120.00,
				'night_cost' => 200.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 6,
				'worker_id' => 5,
				'visit_required' => 1,
				'day_cost' => 150.00,
				'night_cost' => 230.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 5,
				'worker_id' => 6,
				'visit_required' => 0,
				'day_cost' => 120.00,
				'night_cost' => 200.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 7,
				'worker_id' => 6,
				'visit_required' => 0,
				'day_cost' => 150.00,
				'night_cost' => 230.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 5,
				'worker_id' => 7,
				'visit_required' => 0,
				'day_cost' => 110.00,
				'night_cost' => 180.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			],[
				'service_id' => 8,
				'worker_id' => 7,
				'visit_required' => 0,
				'day_cost' => 150.00,
				'night_cost' => 230.00,
				'days' => '{"dom_am": false, "dom_pm": false, "jue_am": false, "jue_pm": true, "lun_am": false, "lun_pm": true, "mar_am": false, "mar_pm": true, "mie_am": false, "mie_pm": true, "sab_am": false, "sab_pm": true, "vie_am": false, "vie_pm": true, "dom_24h": false, "jue_24h": false, "lun_24h": false, "mar_24h": false, "mie_24h": false, "sab_24h": false, "vie_24h": false}'
			]
		]);
	}
}