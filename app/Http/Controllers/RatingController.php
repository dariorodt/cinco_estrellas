<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\Worker;
use App\ServiceOrder;
use App\WorkerRating;
use App\Notifications\HaveBeenRated;

class RatingController extends Controller
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
	 * Show the ratings index view
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenRated') as $notification) {
			$notification->markAsRead();
		}
		
		$client_ratings = Auth::user()->ratings()->paginate(5);
		
		return view('ratings', [
			'user' => Auth::user(),
			'client_ratings' => $client_ratings,
		]);
	}
	
	
	public function create(ServiceOrder $order)
	{
		// TODO: Show worker rating creation form
		return view('rating-create', ['order' => $order]);
	}
	
	
	public function store(Request $request, ServiceOrder $order)
	{
		//dd($request->all());
		
		$request->validate([
			'service_order_id' => 'required|integer',
			'worker_id' => 'required|integer',
			'sender_id' => 'required|integer',
			'stars' => 'required|numeric',
			'comment' => 'required',
		]);
		
		$worker_rating = new WorkerRating;
		$worker_rating->fill($request->all())->save();
		
		$order->worker->notify(new HaveBeenRated($order));
		
		return redirect()->route('user.ratings')->with('success', 'Ha calificado con éxito al trabajador');
	}
}
