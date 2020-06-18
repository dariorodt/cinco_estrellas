<?php

use Illuminate\Database\Seeder;

class WorkerProfilesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('worker_profiles')->insert([
			[
				'worker_id' => 1,
				'state' => 'inactive',
				'f_name' => 'Ismael',
				'l_name' => 'Salazar',
				'birthday' => '1996-10-08',
				'phone' => '563324596658',
				'gender' => 'male',
				'nationality' => 'Chile',
				'comunity' => 'Santiago',
				'city' => 'Santiago',
				'street' => '56',
				'block' => '642',
				'about_me' => 'Soy el mero, mero',
				'image_path' => 'images/workers/1568213635.jpg'
			],[
				'worker_id' => 2,
				'state' => 'inactive',
				'f_name' => 'Patricia',
				'l_name' => 'Toledo',
				'birthday' =>  '1992-11-06',
				'phone' =>  '568489658896',
				'gender' =>  'female',
				'nationality' =>  'Chile',
				'comunity' => 'Santiago',
				'city' =>  'Santiago',
				'street' =>  'Los cerezos',
				'block' =>  '357',
				'about_me' =>  'Bella como una flor',
				'image_path' =>  'images/workers/1568213788.jpg'
			],[
				'worker_id' => 3,
				'state' => 'inactive',
				'f_name' => 'Fernando',
				'l_name' => 'Quevedo',
				'birthday' =>  '1968-07-23',
				'phone' =>  '563325669191',
				'gender' =>  'male',
				'nationality' =>  'Chile',
				'comunity' => 'Santiago',
				'city' =>  'Santiago',
				'street' =>  'Las acacias',
				'block' =>  '369',
				'about_me' =>  'Frenético y enfocado',
				'image_path' =>  'images/workers/1568213950.jpg'
			],[
				'worker_id' => 4,
				'state' => 'inactive',
				'f_name' => 'Estefanía',
				'l_name' => 'Pérez',
				'birthday' =>  '1995-09-06',
				'phone' =>  '584129490074',
				'gender' =>  'female',
				'nationality' =>  'Chile',
				'comunity' => 'Santiago',
				'city' =>  'Santiago',
				'street' =>  'La Paz',
				'block' =>  '357',
				'about_me' =>  'Soy el viento que golpea la ola',
				'image_path' =>  'images/workers/1568233988.jpg'
			],[
				'worker_id' => 5,
				'state' => 'inactive',
				'f_name' => 'Lisandro',
				'l_name' => 'Gómez',
				'birthday' =>  '1977-07-12',
				'phone' =>  '563228286495',
				'gender' =>  'male',
				'nationality' =>  'Chile',
				'comunity' => 'Santiago',
				'city' =>  'Santiago',
				'street' =>  'Cáceres',
				'block' =>  '456',
				'about_me' =>  'Ambicioso y centrado',
				'image_path' =>  'images/workers/1568214300.jpg'
			],[
				'worker_id' => 6,
				'state' => 'inactive',
				'f_name' => 'Mariela',
				'l_name' => 'Diamante',
				'birthday' =>  '1996-11-28',
				'phone' =>  '568559658485',
				'gender' =>  'female',
				'nationality' =>  'Chile',
				'comunity' => 'Santiago',
				'city' =>  'Santiago',
				'street' =>  'Viñedos',
				'block' =>  '97',
				'about_me' =>  'Soy del tamaño del problema que tengo en frente',
				'image_path' =>  'images/workers/1568214432.jpg'
			],[
				'worker_id' => 7,
				'state' => 'inactive',
				'f_name' => 'Sofía',
				'l_name' => 'Herrádez',
				'birthday' =>  '1989-04-04',
				'phone' =>  '563224515566',
				'gender' =>  'female',
				'nationality' =>  'Chile',
				'comunity' => 'Santiago',
				'city' =>  'Santiago',
				'street' =>  'La Luz',
				'block' =>  '987',
				'about_me' =>  'Enfocada y analítica',
				'image_path' =>  'images/workers/1568214594.jpg'
			]
		]);
	}
}
