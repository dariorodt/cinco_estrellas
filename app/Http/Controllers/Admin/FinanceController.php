<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\WorkerPayment;

class FinanceController extends Controller
{
	/**
	 * Create a new controller instance
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
	
	/**
	 * Display a list of pending payments
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function client_payments()
	{
		return view('admin.client-payments', [
			'payments' => Payment::where('worker_paid', false)->get(),
		]);
	}
	
	/**
	 * Display a list of done payments
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function worker_payments()
	{
		return view('admin.worker-payments', ['payments' => WorkerPayment::all()]);
	}
	
	/**
	 * Register the payment made to workers
	 * 
	 * @param  Request $request 
	 * @param  Payment $payment 
	 * @return Illuminate\Http\Response
	 */
	public function payment_register(Request $request, Payment $payment)
	{
		if ($request->isMethod('get')) {
			return view('admin.worker-payment-register', ['payment' => $payment]);
		}
		
		$request->validate([
			'f_name' => 'required',
			'l_name' => 'required',
			'rut' => 'required',
			'bank' => 'required',
			'account' => 'required',
			'email' => 'required',
			'amount' => 'required',
		]);
		
		WorkerPayment::create($request->input());
		
		$payment->worker_paid = true;
		$payment->save();
		
		return redirect()->route('admin.finance.worker.payments')->with('success', 'Pago registrado corectamente');
	}
	
	public function show_payment(WorkerPayment $payment)
	{
		return view('admin.worker-payment', ['payment' => $payment]);
	}
}
