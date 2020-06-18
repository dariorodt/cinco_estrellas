<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('worker_id')->unsigned();
            $table->string('name');
            $table->text('comment');
            $table->string('file_type');
            $table->string('file_path');
            $table->timestamps();
            
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
        Schema::dropIfExists('worker_documents');
    }
}
