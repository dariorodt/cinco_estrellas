<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientRatingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_ratings', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('service_order_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->integer('sender_id')->unsigned();
			$table->decimal('stars', 2, 1);
			$table->text('comment');
			$table->timestamps();
			
			$table->foreign('service_order_id')->references('id')->on('service_orders');
			$table->foreign('client_id')->references('id')->on('users');
			$table->foreign('sender_id')->references('id')->on('workers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('client_ratings');
	}
}
