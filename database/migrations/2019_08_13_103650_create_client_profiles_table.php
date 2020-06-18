<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientProfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_profiles', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('status');
			
			// Personal information
			$table->string('f_name');
			$table->string('l_name');
			$table->string('rut')->unique();
			$table->date('birthday');
			$table->string('phone');
			$table->string('gender');
			$table->string('nationality');
			
			// Address
			$table->string('comunity')->nullable();
			$table->string('city')->nullable();
			$table->string('street')->nullable();
			$table->string('block')->nullable();
			
			// About me
			$table->string('about_me')->nullable();
			$table->string('image_path')->nullable();
			
			// Includes created_at/updated_at columns
			$table->timestamps();
			
			// Relationships
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('client_profiles');
	}
}
