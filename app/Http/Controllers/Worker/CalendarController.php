<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ServiceOrder;
use App\Message;
use App\Worker;

class CalendarController extends Controller
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
	 * Show Worker Calendar Widget
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{		
		return view('worker.calendar', [
			'worker' => Auth::user(),
		]);
	}
	
	public function calendar(Worker $worker)
	{
		$this->middleware('auth:web');
		dd($worker);
	}
}
