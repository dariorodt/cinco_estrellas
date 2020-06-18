<?php

use Illuminate\Database\Seeder;

class ClientProfilesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('client_profiles')->insert([
			[
				'user_id' => 1,
				'status' => 'active',
				'f_name' => 'José',
				'l_name' => 'Martínez',
				'rut' => '7818123-0',
				'birthday' => '1997-01-23',
				'phone' => '564446365555',
				'gender' => 'male',
				'nationality' => 'Chile',
				'comunity' => 'Lampa',
				'city' => 'Santiago',
				'street' => 'Las Américas',
				'block' => '98',
				'about_me' => 'Dispuesto y bien plantado',
				'image_path' => 'images/clients/1569189410.jpg'
			],[
				'user_id' => 2,
				'status' => 'active',
				'f_name' => 'Victor',
				'l_name' => 'Contreras',
				'rut' => '24585256-8',
				'birthday' => '1995-09-26',
				'phone' => '564446361346',
				'gender' => 'male',
				'nationality' => 'Chile',
				'comunity' => 'Pedro Aguirre Cerda',
				'city' => 'Santiago',
				'street' => 'Arismendi',
				'block' => '489',
				'about_me' => 'Soy libre. Voy donde me lleve el viento',
				'image_path' => 'images/clients/1569190014.jpg'
			],[
				'user_id' => 3,
				'status' => 'active',
				'f_name' => 'Teresa',
				'l_name' => 'Medina',
				'rut' => '12211921-1',
				'birthday' => '1993-07-07',
				'phone' => '564623238855',
				'gender' => 'female',
				'nationality' => 'Chile',
				'comunity' => 'San Pedro',
				'city' => 'Santiago',
				'street' => 'Felipe Torres',
				'block' => '635',
				'about_me' => 'Dulce como la miel, intensa como el sol',
				'image_path' => 'images/clients/1569190192.jpg'
			],[
				'user_id' => 4,
				'status' => 'active',
				'f_name' => 'Miguel',
				'l_name' => 'Castaños',
				'rut' => '10154404-4',
				'birthday' => '1987-09-22',
				'phone' => '565556354859',
				'gender' => 'male',
				'nationality' => 'Chile',
				'comunity' => 'Paine',
				'city' => 'Santiago',
				'street' => 'Santa Fe',
				'block' => '78',
				'about_me' => 'Cuando veas las bardas de tu vecino arder pon las tuyas en remojo',
				'image_path' => 'images/clients/1569190661.jpg'
			],[
				'user_id' => 5,
				'status' => 'active',
				'f_name' => 'Gabriela',
				'l_name' => 'Lara',
				'rut' => '23701213-5',
				'birthday' => '1993-02-26',
				'phone' => '569891636688',
				'gender' => 'female',
				'nationality' => 'Chile',
				'comunity' => 'La Cisterna',
				'city' => 'Santiago',
				'street' => 'Manuel Regente',
				'block' => '556',
				'about_me' => 'Soy fuerte. Valiente. Enfrento la vida con optimismo y valor',
				'image_path' => 'images/clients/1569191203.jpg'
			],[
				'user_id' => 6,
				'status' => 'active',
				'f_name' => 'Daniela',
				'l_name' => 'Rodríguez',
				'rut' => '7855855-5',
				'birthday' => '1997-08-06',
				'phone' => '562323499944',
				'gender' => 'female',
				'nationality' => 'Chile',
				'comunity' => 'Vitacura',
				'city' => 'Santiago',
				'street' => 'Los Jardines',
				'block' => '565',
				'about_me' => 'Vivo la vida a toda velocidad',
				'image_path' => 'images/clients/1569191382.jpg'
			],[
				'user_id' => 7,
				'status' => 'active',
				'f_name' => 'Gerardo',
				'l_name' => 'Vélez',
				'rut' => '22516239-5',
				'birthday' => '1997-05-14',
				'phone' => '569884897152',
				'gender' => 'male',
				'nationality' => 'Chile',
				'comunity' => 'Til til',
				'city' => 'Santiago',
				'street' => 'Colina',
				'block' => '705',
				'about_me' => 'Yoga todas las noches. Deportes los fines de semana',
				'image_path' => 'images/clients/1569191558.jpg'
			]
		]);
	}
}