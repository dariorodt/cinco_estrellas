<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\ServiceOrder;
use App\Message;
use App\Notifications\HaveBeenRated;
use App\ClientRating;

class RatingController extends Controller
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
	 * Show User Rating List
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		foreach (Auth::user()->unreadNotifications
		         ->where('type', 'App\Notifications\HaveBeenRated') as $notification) {
			$notification->markAsRead();
		}
		
		$worker_ratings = Auth::user()->ratings()->paginate(5);
		
		return view('worker.ratings', [
			'worker' => Auth::user(),
			'worker_ratings' => $worker_ratings,
		]);
	}
	
	/**
	 * Show the create new rating form
	 * 
	 * @param  ServiceOrder $order
	 * @return Illuminate\Http\Response
	 */
	public function create(ServiceOrder $order)
	{
		return view('worker.rating-create', [
			'worker' => Auth::user(),
			'order' => $order,
		]);
	}
	
	/**
	 * Store a new rating into de ratings table
	 * 
	 * @param  Request      $request 
	 * @param  ServiceOrder $order   
	 * @return Illuminte\Http\Response
	 */
	public function store(Request $request, ServiceOrder $order)
	{
		$request->validate([
			'service_order_id' => 'required|integer',
			'client_id' => 'required|integer',
			'sender_id' => 'required|integer',
			'stars' => 'required|numeric',
			'comment' => 'required|string',
		]);
		
		$rating = new ClientRating;
		$rating->fill($request->all())->save();
		
		$order->client->notify(new HaveBeenRated($order));
		
		return redirect()->route('worker.ratings')->with('success', 'El Cliente ha sido calificado exitosamente');
	}
}
