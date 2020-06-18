<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});


// WebPay return routes
Route::post('webpay/{order}/return/{worker}', 'WebPayController@return')->name('webpay.return');
Route::post('webpay/{order}/final/{worker}', 'WebPayController@final')->name('webpay.final');

// AJAX Routes
Route::get('worker/{worker}/calendar', function(App\Worker $worker) {
	
	$result = array();
	
	foreach ($worker->service_orders as $order) {
		$event = array(
			'title' => 'Orden nro: '.$order->id.'. Servicio de '.$order->service->name,
			'start' => $order->starting_date.' '.$order->starting_time,
			'end' => $order->ending_date.' '.$order->ending_time,
			'client' => $order->client->profile->full_name(),
			'description' => $order->aditional_info,
			'timetable' => 'De '.$order->starting_time.' a '.$order->ending_time,
		);
		array_push($result, $event);
	}
	
	return $result;
	
})->name('worker.calendar.calendar');

Route::get('user/{user}/calendar', function(App\User $user) {
	
	$result = array();
	
	foreach ($user->service_orders as $order) {
		$event = array(
			'title' => 'Orden nro: '.$order->id.'. Servicio de '.$order->service->name,
			'start' => $order->starting_date.' '.$order->starting_time,
			'end' => $order->ending_date.' '.$order->ending_time,
			'client' => $order->client->profile->full_name(),
			'description' => $order->aditional_info,
			'timetable' => 'De '.$order->starting_time.' a '.$order->ending_time,
		);
		array_push($result, $event);
	}
	
	return $result;
	
})->name('user.calendar.calendar');

Route::get('finance/get-daily-sales/{days}', function($days) {
	for ($i=0; $i < $days; $i++) { 
		$date = \Carbon\Carbon::now()->subDay($i)->toDateString();
		$amount = App\Payment::all()->filter(function($payment) use(&$date) {
			return \Carbon\Carbon::create($payment->payment_date)->toDateString() == $date;
		})->sum('amount');
		$data[] = (object) ['y' => $date ,'item1' => $amount];
	}
	
	return $data;
});
