<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('worker_id');
            $table->unsignedInteger('order_id');
            // WebPay first response
            $table->string('token_ws');
            $table->integer('authorization_code');
            $table->string('payment_type', 2);
            $table->decimal('shares_amount', 12, 2);
            $table->tinyInteger('shares_number');
            $table->timestamp('payment_date');
            // WebPay transaction confirmation
            $table->string('card_number')->nullable();
            $table->string('card_expire_date')->nullable();
            $table->boolean('worker_paid')->default(false);
            $table->decimal('amount');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->foreign('order_id')->references('id')->on('service_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
/*
transactionResultOutput {#428 ▼
  +accountingDate: "1111"
  +buyOrder: "1"
  +cardDetail: cardDetail {#440 ▼
    +cardNumber: "6623"
    +cardExpirationDate: null
  }
  +detailOutput: wsTransactionDetailOutput {#438 ▼
    +authorizationCode: "1213"
    +paymentTypeCode: "VN"
    +responseCode: 0
    +"sharesNumber": 0
    +"amount": "220"
    +"commerceCode": "597020000540"
    +"buyOrder": "1"
  }
  +sessionId: "espnyHqVkfLnJ4CVgDeL7OlS7aYrt8NdEBVmbLnM"
  +transactionDate: "2019-11-11T17:48:45.409-03:00"
  +urlRedirection: "https://webpay3gint.transbank.cl/webpayserver/voucher.cgi"
  +VCI: "TSY"
}


Aceptada TDC sin cuotas....................

wsTransactionDetailOutput {#438 ▼
  +authorizationCode: "1213"
  +paymentTypeCode: "VN"
  +responseCode: 0
  +"sharesNumber": 0
  +"amount": "220"
  +"commerceCode": "597020000540"
  +"buyOrder": "1"
}

Rechazada TDC sin cuotas..................

wsTransactionDetailOutput {#438 ▼
  +authorizationCode: "000000"
  +paymentTypeCode: "VN"
  +responseCode: -3
  +"sharesNumber": 0
  +"amount": "220"
  +"commerceCode": "597020000540"
  +"buyOrder": "1"
  +"responseDescription": "Error en transacción"
}

Aprobada TDC con cuotas..................

wsTransactionDetailOutput {#438 ▼
  +authorizationCode: "1213"
  +paymentTypeCode: "NC" // crédito
  +responseCode: 0
  +"sharesAmount": "55" // monto cuotas
  +"sharesNumber": 4 // número cuotas
  +"amount": "220"
  +"commerceCode": "597020000540"
  +"buyOrder": "1"
}

Aceptada TDD........................

wsTransactionDetailOutput {#438 ▼
  +authorizationCode: "1415"
  +paymentTypeCode: "VD"
  +responseCode: 0
  +"sharesNumber": 0
  +"amount": "240"
  +"commerceCode": "597020000540"
  +"buyOrder": "3"
}

Rechazada TDD.......................

wsTransactionDetailOutput {#438 ▼
  +authorizationCode: "000000"
  +paymentTypeCode: "VD"
  +responseCode: -3
  +"sharesNumber": 0
  +"amount": "240"
  +"commerceCode": "597020000540"
  +"buyOrder": "3"
  +"responseDescription": "Error en transacción"
}
 */
