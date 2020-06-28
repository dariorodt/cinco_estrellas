<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Job;
use App\ServiceOrder;
use App\Message;
use App\Application;
use App\Notifications\ApplicationReceived;

class JobController extends Controller
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
	 * Shows the list of posted jobs in which the job category matches with any 
	 * of the service categories defined by this worker.
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		// Set JobPosted notifications as read if any
		foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\JobPosted') as $notification) {
			$notification->markAsRead();
		}
		
		$open_orders = ServiceOrder::where('status', 'open')
			->whereIn('service_id', Auth::user()->services->pluck('id'))
			->paginate(10);
		
		return view('worker.jobs', [
			'worker' => Auth::user(),
			'open_orders' => $open_orders,
		]);
	}
	
	/**
	 * Show service indicated in argument
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function detail(ServiceOrder $order)
	{
		// Show service order detail
	}
	
	/**
	 * 
	 */
	public function apply(ServiceOrder $order)
	{
		Application::create([
			'job_id' => $order->id,
			'worker_id' => Auth::id(),
		]);
		
		$order->client->notify(new ApplicationReceived($order));
		
		return back()->with('success', 'Ha aplicado al servicio con éxito');
	}
	
	/**
	 * 
	 */
	public function close()
	{
		// Close service
	}
}
