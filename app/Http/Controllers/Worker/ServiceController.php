<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\ServiceOrder;
use App\Message;

class ServiceController extends Controller
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
	 * Show Service Order List
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function index()
	{
		$my_services = Auth::user()->services->pluck('id');
		$orders_count = ServiceOrder::where('status', 'open')->whereIn('service_id', $my_services)->count();
		$messages = Message::where('worker_id', Auth::id())->get()->unique('job_id');
		$messages_count = $messages->where('viewed', 0)->count();
		
		return view('worker.services', [
			'worker' => Auth::user(),
			'services' => Auth::user()->services,
			'orders_count' => $orders_count,
			'messages' => $messages,
			'messages_count' => $messages_count
		]);
	}
	
	/**
	 * Show the create new service form
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function create()
	{	
		return view('worker.service-create', [
			'worker' => Auth::user(),
			'services' => Service::all(),
		]);
	}
	
	public function store(Request $request)
	{
		//dd($request->all());
		
		// Validate input (only day_cost & night_cost)
		$this->validate($request, [
			'service' => 'required|integer', 
			'day_cost' => 'required|numeric', 
			'night_cost' => 'required|numeric'
		]);
		
		// Capture available day options
		$days = new \stdClass();
		
		$request->lun_am == "on"	? 	$days->lun_am = true 	: 	$days->lun_am = false;
		$request->lun_pm == "on"	? 	$days->lun_pm = true 	: 	$days->lun_pm = false;
		$request->lun_24h == "on"	? 	$days->lun_24h = true 	: 	$days->lun_24h = false;
		$request->mar_am == "on"	? 	$days->mar_am = true 	: 	$days->mar_am = false;
		$request->mar_pm == "on"	? 	$days->mar_pm = true 	: 	$days->mar_pm = false;
		$request->mar_24h == "on"	? 	$days->mar_24h = true 	: 	$days->mar_24h = false;
		$request->mie_am == "on"	? 	$days->mie_am = true 	: 	$days->mie_am = false;
		$request->mie_pm == "on"	? 	$days->mie_pm = true 	: 	$days->mie_pm = false;
		$request->mie_24h == "on"	? 	$days->mie_24h = true 	: 	$days->mie_24h = false;
		$request->jue_am == "on"	? 	$days->jue_am = true 	: 	$days->jue_am = false;
		$request->jue_pm == "on"	? 	$days->jue_pm = true 	: 	$days->jue_pm = false;
		$request->jue_24h == "on"	? 	$days->jue_24h = true 	: 	$days->jue_24h = false;
		$request->vie_am == "on"	? 	$days->vie_am = true 	: 	$days->vie_am = false;
		$request->vie_pm == "on"	? 	$days->vie_pm = true 	: 	$days->vie_pm = false;
		$request->vie_24h == "on"	? 	$days->vie_24h = true 	: 	$days->vie_24h = false;
		$request->sab_am == "on"	? 	$days->sab_am = true 	: 	$days->sab_am = false;
		$request->sab_pm == "on"	? 	$days->sab_pm = true 	: 	$days->sab_pm = false;
		$request->sab_24h == "on"	? 	$days->sab_24h = true 	: 	$days->sab_24h = false;
		$request->dom_am == "on"	? 	$days->dom_am = true 	: 	$days->dom_am = false;
		$request->dom_pm == "on"	? 	$days->dom_pm = true 	: 	$days->dom_pm = false;
		$request->dom_24h == "on"	? 	$days->dom_24h = true 	: 	$days->dom_24h = false;
		
		Auth::user()->services()->syncWithoutDetaching([
			$request->service => [
				'visit_required' => $request->visit_required ? 1 : 0, 
				'day_cost' => $request->day_cost ? $request->day_cost : null, 
				'night_cost' => $request->night_cost ? $request->night_cost : null, 
				'days' => json_encode($days)
			]
		]);
		
		// Return to index view
		return redirect()->route('worker.services')->withInput()->with('success', 'Servicio añadido con éxito');
	}
	
	
	public function new()
	{
		return view('worker.service-add', [
			'worker' => Auth::user(),
		]);
	}
	
	
	public function add(Request $request)
	{
		Service::create($request->all());
		
		return redirect()->route('worker.services')->with('success', 'Su solicitud fue creada con éxito');
	}
	
	
	/**
	 * Show the Service Edit Form, sending all service for this worker and the 
	 * service to edit.
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function edit(Request $request, Service $service)
	{
		$service->pivot = json_decode(Auth::user()->services->find($service)->pivot);
		
		// Transform the days field (JSON) into an object...
		$service->pivot->days = json_decode($service->pivot->days);
		
		$services = Service::all();
		
		$messages = Message::where('worker_id', Auth::id())->get()->unique('job_id');
		$messages_count = $messages->where('viewed', 0)->count();
		
		return view('worker.service-edit', [
			'service'  => $service,
			'services' => $services,
			'worker'   => Auth::user(),
			'messages' => $messages,
			'messages_count' => $messages_count,
		]);
	}
	
	
	/**
	 * Update the given service with the upcoming input
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function update(Request $request, Service $service)
	{	
		//dd($request->all());
		
		// Capture available day options
		$days = new \stdClass();
		
		$request->lun_am == "on"	? 	$days->lun_am = true 	: 	$days->lun_am = false;
		$request->lun_pm == "on"	? 	$days->lun_pm = true 	: 	$days->lun_pm = false;
		$request->lun_24h == "on"	? 	$days->lun_24h = true 	: 	$days->lun_24h = false;
		$request->mar_am == "on"	? 	$days->mar_am = true 	: 	$days->mar_am = false;
		$request->mar_pm == "on"	? 	$days->mar_pm = true 	: 	$days->mar_pm = false;
		$request->mar_24h == "on"	? 	$days->mar_24h = true 	: 	$days->mar_24h = false;
		$request->mie_am == "on"	? 	$days->mie_am = true 	: 	$days->mie_am = false;
		$request->mie_pm == "on"	? 	$days->mie_pm = true 	: 	$days->mie_pm = false;
		$request->mie_24h == "on"	? 	$days->mie_24h = true 	: 	$days->mie_24h = false;
		$request->jue_am == "on"	? 	$days->jue_am = true 	: 	$days->jue_am = false;
		$request->jue_pm == "on"	? 	$days->jue_pm = true 	: 	$days->jue_pm = false;
		$request->jue_24h == "on"	? 	$days->jue_24h = true 	: 	$days->jue_24h = false;
		$request->vie_am == "on"	? 	$days->vie_am = true 	: 	$days->vie_am = false;
		$request->vie_pm == "on"	? 	$days->vie_pm = true 	: 	$days->vie_pm = false;
		$request->vie_24h == "on"	? 	$days->vie_24h = true 	: 	$days->vie_24h = false;
		$request->sab_am == "on"	? 	$days->sab_am = true 	: 	$days->sab_am = false;
		$request->sab_pm == "on"	? 	$days->sab_pm = true 	: 	$days->sab_pm = false;
		$request->sab_24h == "on"	? 	$days->sab_24h = true 	: 	$days->sab_24h = false;
		$request->dom_am == "on"	? 	$days->dom_am = true 	: 	$days->dom_am = false;
		$request->dom_pm == "on"	? 	$days->dom_pm = true 	: 	$days->dom_pm = false;
		$request->dom_24h == "on"	? 	$days->dom_24h = true 	: 	$days->dom_24h = false;
		
		Auth::user()->services()->updateExistingPivot($service->id, [
			'visit_required' => $request->visit_required ? 1 : 0 ,
			'day_cost' => $request->day_cost ? $request->day_cost : null, 
			'night_cost' => $request->night_cost ? $request->night_cost : null, 
			'days' => json_encode($days)
		]);
		
		// Return to index view
		return back()->withInput()->with('success', 'Servicio actalizado con éxito');
	}
	
	
	/**
	 * Delete the given sevice
	 * 
	 * @return \Illuminate\Http\Response Response class instance
	 */
	public function delete(Service $service)
	{
		Auth::user()->services()->detach($service->id);
		
		$warning = 'Servicio '.$service->name.' eliminado...';
		
		return redirect()->route('worker.services')->with('warning', $warning);
	}
}