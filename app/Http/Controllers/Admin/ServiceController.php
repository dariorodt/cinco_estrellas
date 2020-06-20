<?php

namespace App\Http\Controllers\Admin;
// Framework
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
// Models
use App\Service;

class ServiceController extends Controller
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
	 * Display the whole list of services
	 * 
	 * @return Illuminate\Http\Response 
	 */
	public function index()
	{
		return view('admin.services', ['services' => Service::all()]);
	}
	
	/**
	 * Show the create service form
	 * 
	 * @return Illuminate\Http\Response 
	 */
	public function create()
	{
		$fa_icon_list = explode("\n", Storage::get('font-awesome-4-list.txt'));
		
		sort($fa_icon_list);
		
		return view('admin.service-create', ['fa_icon_list' => $fa_icon_list]);
	}
	
	/**
	 * Store the request input into the services table
	 * 
	 * @param  Request $request 
	 * @return Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'icon' => 'required|image',
			'name' => 'required|string',
			'description' => 'required|string'
		]);
		
		$image = $request->file('icon');
		$imagename = time().'.'.$image->getClientOriginalExtension();
		$destination_path = public_path('/uploads/services/');
		$image->move($destination_path, $imagename);
		
		$service = new Service;
		
		$service->icon = 'uploads/services/'.$imagename;
		
		$service->fill($request->input())->save();
		
		return redirect()->route('admin.services')->with('success', 'El nuevo servicio se ha creado correctamente');
	}
	
	/**
	 * Show the edit service form
	 * 
	 * @param  Service $service 
	 * @return Illuminate\Http\Response
	 */
	public function edit(Service $service)
	{
		$fa_icon_list = explode("\n", Storage::get('font-awesome-4-list.txt'));
		
		sort($fa_icon_list);
		
		return view('admin.service-edit', [
			'service' => $service,
			'fa_icon_list' => $fa_icon_list,
		]);
	}
	
	/**
	 * Update the given service with the request input
	 * 
	 * @param  Requtes $request 
	 * @param  Service $service 
	 * @return Illuminate\Http\Response
	 */
	public function update(Request $request, Service $service)
	{
		//dd($request->all());
		$request->validate([
			'icon' => 'required|image',
			'name' => 'required|string',
			'description' => 'required|string'
		]);
		
		if($request->file('icon'))
		{
			$image = $request->file('icon');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/uploads/services/');
			$image->move($destination_path, $imagename);
			
			$service->icon = 'uploads/services/'.$imagename;
		}
		
		$service->fill($request->input())->save();
		
		return back()->with('success', 'Servicio actualizado correctamente');
	}
	
	/**
	 * Change the status of a service to active
	 * 
	 * @param  Service $service 
	 * @return Illuminate\Http\Response
	 */
	public function activate(Service $service)
	{
		$service->status = 'active';
		$service->save();
		
		return back()->with('success', 'Servicio activado correctamente');
	}
	
	
	public function delete(Service $service)
	{
		$serviceName = $service->name;
		
		if ($service->status == 'inactive') {
			$service->delete();
			return back()->with('success', 'Ha eliminado el servicio '.$serviceName);
		} else {
			return back()->with('warning', 'No se puede borrar un servicio activo');
		}
		
	}
}
