<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Worker;
use App\ServiceOrder;
use App\Application;

class WorkerController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
	
	/**
	 * Show whole worker list
	 */
	public function index()
	{
		return view('admin.workers', ['workers' => Worker::all()]);
	}
	
	/**
	 * Show a list of workers thas are inactive
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function show_new_workers()
	{
		// Get all inactive users and send it to the view
		$all_workers = Worker::all();
		
		$workers = [];
		
		foreach ($all_workers as $worker) {
			if ($worker->profile && $worker->profile->state == 'inactive') {
				array_push($workers, $worker);
			}
		}
		
		return view('admin.workers', ['workers' => $workers]);
	}
	
	/**
	 * Show a list of workers thas are active
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function show_active_workers()
	{
		// Get all inactive users and send it to the view
		$all_workers = Worker::all();
		
		$workers = [];
		
		foreach ($all_workers as $worker) {
			if ($worker->profile && $worker->profile->state == 'active') {
				array_push($workers, $worker);
			}
		}
		
		return view('admin.workers', ['workers' => $workers]);
	}
	
	/**
	 * Show the worker edit form
	 * 
	 * @param  Worker $worker
	 * @return Illuminate\Http\Response
	 */
	public function edit(Worker $worker)
	{
		return view('admin.worker-edit', ['worker' => $worker]);
	}
	
	/**
	 * Update the status for the giver worker
	 * 
	 * @param  Request $request 
	 * @param  Worker  $worker  
	 * @return Illuminate\Http\Response
	 */
	public function update(Request $request, Worker $worker)
	{
		if ($request->active) 
		{
			$worker->profile->state = 'active';
			$worker->profile->save();
		}
		if ($request->inactive)
		{
			$worker->profile->state = 'inactive';
			$worker->profile->save();
		}
		
		return back();
	}
	
	/**
	 * List the Jobs that have been accepted (status: 'active', 'closed')
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function jobs()
	{
		return view('admin.worker-jobs', [
			'jobs' => ServiceOrder::whereIn('status', ['active', 'closed'])->get(),
		]);
	}
	
	/**
	 * Show the list of applications for all workers.
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function applications()
	{
		return view('admin.worker-applications', [
			'applications' => Application::all(),
		]);
	}
	
	
	public function delete(Request $request, Worker $worker)
	{
		$worker->delete();
		
		return back()->with('success', 'Se ha borrado con éxito en trabajador '.$worker->email);
	}
}
