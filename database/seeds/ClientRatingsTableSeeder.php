<?php

use Illuminate\Database\Seeder;

class ClientRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_ratings')->insert([
			// Client 1
			[
				'service_order_id' => 1,
				'client_id' => 1, 
				'sender_id' => 3, 
				'stars' => 4, 
				'comment' => 'Muy respetuoso y atento.'
			],
			[
				'service_order_id' => 3,
				'client_id' => 1, 
				'sender_id' => 5, 
				'stars' => 3, 
				'comment' => 'Muy exigente'
			],
			[
				'service_order_id' => 15,
				'client_id' => 1, 
				'sender_id' => 7, 
				'stars' => 4, 
				'comment' => 'Cliente muy amable y cordial. Lo recomiendo.'
			],
			// Client 2
			[
				'service_order_id' => 14,
				'client_id' => 2, 
				'sender_id' => 3, 
				'stars' => 5, 
				'comment' => 'Lo recomiento'
			],
			[
				'service_order_id' => 17,
				'client_id' => 2, 
				'sender_id' => 6, 
				'stars' => 5, 
				'comment' => 'Cliente muy recomendable.'
			],
			// Client 3
			[
				'service_order_id' => 2,
				'client_id' => 3, 
				'sender_id' => 1, 
				'stars' => 3, 
				'comment' => 'Amable pero indeciso'
			],
			[
				'service_order_id' => 8,
				'client_id' => 3, 
				'sender_id' => 4, 
				'stars' => 1, 
				'comment' => 'No pudimos ponernos de acuerdo'
			],
			[
				'service_order_id' => 19,
				'client_id' => 3, 
				'sender_id' => 2, 
				'stars' => 2, 
				'comment' => 'Muy malgeniado'
			],
			// Client 4
			[
				'service_order_id' => 4,
				'client_id' => 4, 
				'sender_id' => 7, 
				'stars' => 3, 
				'comment' => 'Bueno, amable'
			],
			[
				'service_order_id' => 12,
				'client_id' => 4, 
				'sender_id' => 2, 
				'stars' => 5, 
				'comment' => 'Muy educado y amable.'
			],
			[
				'service_order_id' => 18,
				'client_id' => 4, 
				'sender_id' => 6, 
				'stars' => 2, 
				'comment' => 'No expresa bien lo que requiere'
			],
			// Client 5
			[
				'service_order_id' => 5,
				'client_id' => 5, 
				'sender_id' => 5, 
				'stars' => 4, 
				'comment' => 'Muy buen cliente'
			],
			[
				'service_order_id' => 7,
				'client_id' => 5, 
				'sender_id' => 1, 
				'stars' => 4, 
				'comment' => 'Muy atento y considerado'
			],
			[
				'service_order_id' => 11,
				'client_id' => 5, 
				'sender_id' => 3, 
				'stars' => 5, 
				'comment' => 'Responsable y puntual'
			],
			// Client 6
			[
				'service_order_id' => 6,
				'client_id' => 6, 
				'sender_id' => 2, 
				'stars' => 4, 
				'comment' => 'Atento. Trata bien al trabajador'
			],
			[
				'service_order_id' => 10,
				'client_id' => 6, 
				'sender_id' => 5, 
				'stars' => 3, 
				'comment' => 'Atento'
			],
			[
				'service_order_id' => 13,
				'client_id' => 6, 
				'sender_id' => 4, 
				'stars' => 4, 
				'comment' => 'Me trató muy bien. Muy consciente'
			],
			// Client 7
			[
				'service_order_id' => 9,
				'client_id' => 7, 
				'sender_id' => 6, 
				'stars' => 5, 
				'comment' => 'Muy amable'
			],
			[
				'service_order_id' => 16,
				'client_id' => 7, 
				'sender_id' => 5, 
				'stars' => 4, 
				'comment' => 'Buen trato'
			],
		]);
    }
}
