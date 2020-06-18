<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('worker_id');
            $table->unsignedInteger('service_order_id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('rut');
            $table->string('bank');
            $table->string('account');
            $table->string('email');
            $table->decimal('amount');
            $table->timestamps();
            
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->foreign('service_order_id')->references('id')->on('service_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_payments');
    }
}
