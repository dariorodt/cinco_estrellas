<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
		$this->middleware('auth:worker');
	}
	
	/**
	 * Show User Messages Widget
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\MessageReceived') as $notification) {
			$notification->markAsRead();
		}
		return view('worker.messages', [
			'worker' => Auth::user(),
			'messages' => Auth::user()->messages->unique('jod_id'),
		]);
	}
	
	/**
	 * Show the new message form
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function chat(ServiceOrder $order)
	{
		return view('worker.messages-chat', [
			'worker' => Auth::user(),
			'order' => $order,
		]);
	}
	
	/**
	 * Store a new message into a service roder chat panel
	 * 
	 * @param  Request      $request
	 * @param  ServiceOrder $order
	 * @return Illuminate\Htto\Response
	 */
	public function send(Request $request, ServiceOrder $order)
	{
		//dd($request->all());
		
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
		
		// Notify client
		$order->client->notify(new MessageReceived($order));
		
		return back();
	}
}
