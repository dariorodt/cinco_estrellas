<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_profiles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('admin_id')->unsigned();
			$table->string('state');
			$table->string('name');
			$table->string('image');
			$table->timestamps();
			
			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('admin_profiles');
	}
}
