<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
			[
				'status' => 'active',
				'name' => 'Aseo', 
				'description' => 'Limpieza doméstica y empresaral. Sólo pisos, muebles, baños y cocinas. No incluye cuidado de personas',
				'fa_icon' => 'fa-home',
			],[
				'status' => 'active',
				'name' => 'Cocina', 
				'description' => 'Preparado de platos para desayunos, comidas y cenas.',
				'fa_icon' => 'fa-coffee',
			],[
				'status' => 'active',
				'name' => 'Jardineria', 
				'description' => 'Diseño y mantenimiento de jardines interiores y exteriores.',
				'fa_icon' => 'fa-tree',
			],[
				'status' => 'active',
				'name' => 'Niñera', 
				'description' => 'Cuidado de niños hasta 11 años. No incluye niños con condiciones especiales.',
				'fa_icon' => 'fa-female',
			],[
				'status' => 'active',
				'name' => 'Lavado de autos', 
				'description' => 'Lavado de vehículos de uso personal. No incluye vehículos comerciales.',
				'fa_icon' => 'fa-car',
			],[
				'status' => 'active',
				'name' => 'Compras', 
				'description' => 'Realización de compras domésticas, mercados, enseres, artículos del hogar...',
				'fa_icon' => 'fa-cart-arrow-down',
			],[
				'status' => 'active',
				'name' => 'Mecánica', 
				'description' => 'Mecánica automotriz a domicilio. Solo vehículos de uso personal.',
				'fa_icon' => 'fa-cogs',
			],[
				'status' => 'active',
				'name' => 'Citas Médicas', 
				'description' => 'Agendamos tus citas y te recordamos la fecha. Hacemos seguimiento.',
				'fa_icon' => 'fa-heart',
			],[
				'status' => 'active',
				'name' => 'Trámites', 
				'description' => 'Realizamos trámites personales, bancarios e institucionales en horario comercial.',
				'fa_icon' => 'fa-pencil-square-o'
			]
		]);
    }
}

/*
Aseo
Cocina
Jardineria
Niñera
Lavado de autos
Compras
Mecánica
Citas Médicas
Trámites
 */
/*
fa-home
fa-coffee
fa-tree
fa-female
fa-car
fa-cart-arrow-down
fa-cogs
fa-heart
fa-pencil-square-o
*/