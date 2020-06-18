<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Payment;
use App\ServiceOrder;
use App\Message;

class PaymentController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:worker');
	}
	
	/**
	 * Show User Payment list
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		// Set notifications as readed if any
		foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenHired') as $notification) {
			$notification->markAsRead();
		}
		
		return view('worker.payments', [
			'worker' => Auth::user(),
		]);
	}
}
