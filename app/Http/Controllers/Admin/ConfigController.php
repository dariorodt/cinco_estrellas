<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
	/**
	 * Creates a new controller instance
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
		$this->Config = json_decode(Storage::get('app-config.json'));
	}
	
	/**
	 * Show the Config View
	 * 
	 * @return Illuminate\Http\Response 
	 */
	public function show()
	{
		return view('admin.app-config', [
			'express_percentage' => $this->Config->express_percentage,
		]);
	}
	
	/**
	 * Update the configuration file.
	 * 
	 * @param  Request  $request
	 * @return Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$this->Config->express_percentage = (float)$request->express_percentage;
		Storage::put('app-config.json', json_encode($this->Config, JSON_PRETTY_PRINT));
		
		return back();
	}
}
