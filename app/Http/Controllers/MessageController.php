<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\ServiceOrder;
use App\Notifications\MessageReceived;

class MessageController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	 * Show the messages index view
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\MessageReceived') as $notification) {
			$notification->markAsRead();
		}
		
		return view('messages', [
			'user' => Auth::user(),
			'orders' => Auth::user()->service_orders,
		]);
	}
	
	/**
	 * Show the user chat panel
	 * 
	 * @param  ServiceOrder $order 
	 * @return Illuminate\Http\Response
	 */
	public function chat(ServiceOrder $order)
	{
		return view('messages-chat', [
			'user' => Auth::user(),
			'order' => $order,
		]);
	}
	
	/**
	 * Store a new message in the massages table associated with this order
	 * 
	 * @param  Request      $request
	 * @param  ServiceOrder $order
	 * @return Illuminate\Http\Response
	 */
	public function send(Request $request, ServiceOrder $order)
	{
		// Validate request input
		$validateMessage = $request->validate([
			'user_id' => 'integer|required',
			'worker_id' => 'integer|required',
			'sender' => 'string|required',
			'body' => 'required',
		]);
		
		// Store message in the messages table
		$message = new Message;
		$message->job_id = $order->id;
		$message->fill($request->all())->save();
		
		// Notify worker
		$order->worker->notify(new MessageReceived($order));
		
		return back();
	}
}
