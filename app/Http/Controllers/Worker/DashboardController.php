<?php

namespace App\Http\Controllers\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\WorkerProfile;
use App\ServiceOrder;
use App\Message;
use App\WorkerDocument;

class DashboardController extends Controller
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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		return view('worker.dashboard', [
			'user' => Auth::user(),
		]);
	}
	
	
	/**
	 * Update the personal information record, or create it if doesn't exist.
	 * 
	 * @return \Illuminte\Http\Response Response class instance
	 */
	public function update_profile(Request $request)
	{
		$this->validate($request,[
			'prof_img' => 'image|mimes:jpeg,bmp,png,jpg|max:50000',
			'rut' => 'required|regex:/\d{7,8}-\d{1}/',
			'birthday' => 'required|date',
			'f_name' => 'required',
			'l_name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|string',
			'gender' => 'required'
		]);
		
		if (Auth::user()->profile == null) 
		{
			$worker_profile = new WorkerProfile;
		}
		else
		{
			$worker_profile = Auth::user()->profile;
		}
		
		if ($request->file('prof_img'))
		{
			$image = $request->file('prof_img');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/images/workers/');
			$image->move($destination_path, $imagename);
			if (isset($worker_profile->image_path))
				unlink(public_path($worker_profile->image_path));
			$worker_profile->image_path = 'images/workers/'.$imagename;
		}
		
		$worker_profile->worker_id = Auth::id();
		$worker_profile->state = 'inactive';
		$worker_profile->f_name = $request->f_name;
		$worker_profile->l_name = $request->l_name;
		$worker_profile->birthday = $request->birthday;
		$worker_profile->phone = $request->phone;
		$worker_profile->gender = $request->gender;
		$worker_profile->nationality = $request->nationality;
		$worker_profile->comunity = $request->comunity;
		$worker_profile->city = $request->city;
		$worker_profile->street = $request->street;
		$worker_profile->block = $request->block;
		$worker_profile->about_me = $request->about_me;
		
		$worker_profile->save();
		
		return back()->withInput();
	}
	
	/**
	 * Show the documents list uploaded by this worker
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function documents()
	{
		
		return view('worker.documents', [
			'user' => Auth::user(),
			'my_documents' => Auth::user()->documents,
		]);
	}
	
	/**
	 * Show the document upload form
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function document_upload()
	{
		return view('worker.document-upload', [
			'user' => Auth::user(),
		]);
	}
	
	/**
	 * Reveives the image file sent from user browser and store it in the server,
	 * and registers the it in the documents table.
	 * 
	 * @return Illuminate\Http description
	 */
	public function document_add(Request $request) 
	{	
		$document = new WorkerDocument;
		
		if ($request->file('document_image'))
		{
			$image = $request->file('document_image');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/uploads/');
			$image->move($destination_path, $imagename);
			
			$document->file_path = 'uploads/'.$imagename;
		}
		
		$document->fill($request->input())->save();
		
		return redirect()->route('worker.documents')->with('success', 'Su documento ha sido registrado con éxito');
	}
	
	/**
	 * Show the document edit form
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function document_edit(WorkerDocument $document)
	{
		return view('worker.document-edit', [
			'user' => Auth::user(),
			'document' => $document,
		]);
	}
	
	/**
	 * Update data into the documents table related to the given document
	 * 
	 * @param  Request        $request
	 * @param  WorkerDocument $document
	 * @return Illuminate\Http\Response
	 */
	public function document_update(Request $request, WorkerDocument $document) 
	{
		if ($request->file('document_image'))
		{
			$image = $request->file('document_image');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/uploads/');
			$image->move($destination_path, $imagename);
			
			unlink(public_path($document->file_path));
			
			$document->file_path = 'uploads/'.$imagename;
		}
		
		$document->fill($request->input())->save();
		
		return redirect()->route('worker.documents')->with('success', 'Su documento ha sido actualizado con éxito');
	}
	
	/**
	 * Delete the given document
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function document_delete(WorkerDocument $document)
	{
		$document->delete();
		
		return back()->with('warning', 'Documento eliminado con éxito');
	}
}
