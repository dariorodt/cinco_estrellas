<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerProfilesTable extends Migration
{
    // TODO: Ajustar las columnas de la tabla al formulario.
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_profiles', function (Blueprint $table) {
            
            // Auto-generated columns
            $table->increments('id');
            $table->integer('worker_id')->unsigned(); // Access to RUT, email
            $table->string('state');
            
            // Personal information columns
            $table->string('f_name');
            $table->string('l_name');
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
        Schema::dropIfExists('worker_profiles');
    }
}
