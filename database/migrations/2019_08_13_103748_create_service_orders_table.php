<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_orders', function (Blueprint $table) {
			// Identifying and relationships
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('worker_id')->unsigned()->nullable();
			$table->integer('admin_id')->unsigned()->nullable();
			$table->integer('service_id')->unsigned()->nullable();
			
			// Current order status
			$table->enum('status', ['open', 'active', 'closed', 'canceled'])->default('open');
			
			// Service description data
			$table->date('starting_date');
			$table->date('ending_date');
			$table->time('starting_time');
			$table->time('ending_time');
			$table->string('region');
			$table->string('comunity');
			$table->string('city');
			$table->string('aditional_info');
			$table->timestamps();
			
			// TODO: Check if the ServiceOrder model have the relations defined below...
			
			// Users associated with...
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('worker_id')->references('id')->on('workers');
			$table->foreign('admin_id')->references('id')->on('admins');
			$table->foreign('service_id')->references('id')->on('services');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('service_orders');
	}
}
