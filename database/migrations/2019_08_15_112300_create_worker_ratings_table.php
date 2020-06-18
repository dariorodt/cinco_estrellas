<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerRatingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_ratings', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('service_order_id')->unsigned();
			$table->integer('worker_id')->unsigned();
			$table->integer('sender_id')->unsigned();
			$table->decimal('stars', 2, 1);
			$table->mediumText('comment');
			$table->timestamps();
			
			$table->foreign('service_order_id')->references('id')->on('service_orders');
			$table->foreign('worker_id')->references('id')->on('workers');
			$table->foreign('sender_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('worker_ratings');
	}
}
