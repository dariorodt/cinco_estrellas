<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('job_id')->unsigned();
			$table->integer('worker_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('sender');
			$table->text('body')->nullable();
			$table->timestamps();
			
			$table->foreign('job_id')->references('id')->on('service_orders');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('worker_id')->references('id')->on('workers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('messages');
	}
}
