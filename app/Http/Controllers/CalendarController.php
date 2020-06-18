<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
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
     * Show the calendar widget view
     * 
     * @return ILluminate\Http\Response Response class instance
     */
    public function index()
    {
    	return view('calendar', ['user' => Auth::user()]);
    }
}
