<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceWorkerTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_worker', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('service_id')->unsigned();
			$table->integer('worker_id')->unsigned();
			$table->boolean('visit_required')->default(false);
			$table->decimal('visit_cost', 10, 2)->nullable();
			$table->decimal('day_cost')->nullable();
			$table->decimal('night_cost')->nullable();
			$table->mediumText('days')->nullable(); // JSON object
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('service_user');
	}
}
