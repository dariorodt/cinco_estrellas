<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Payment;

class PaymentController extends Controller
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
     * Show the payments index view
     * 
     * @return \Illuminate\Http\Response Response class instance
     */
    public function index()
    {
        // Set HaveBeenRated notificacions as readed if any
        foreach (Auth::user()->notifications->where('type', 'App\Notifications\HaveBeenHired') as $notification) {
            $notification->markAsRead();
        }
        
    	return view('payments', [
            'user' => Auth::user()
        ]);
    }
    
    
    public function detail(Payment $payment)
    {
        return view('payment-detail', [
            'payment' => $payment,
            'user' => Auth::user()
        ]);
    }
}
