<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ClientProfile;
use App\Document;

class HomeController extends Controller
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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		return view('home', ['user' => Auth::user()]);
	}
	
	/**
	 * 
	 */
	public function update_profile(Request $request)
	{
		//dd($request->all());
		
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
		
		// Here we check if the user already has a profile
		if (Auth::user()->profile == null) 
		{
			// If user has no profile, create a new one...
			$client_profile = new ClientProfile;
			$client_profile->status = 'inactive';
		}
		else
		{
			// If user already has a profile, get it...
			$client_profile = Auth::user()->profile;
		}
		
		if($request->file('prof_img'))
		{
			$image = $request->file('prof_img');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/images/clients/');
			$image->move($destination_path, $imagename);
			
			if($client_profile->image_path) unlink(public_path($client_profile->image_path));
			
			$client_profile->image_path = 'images/clients/'.$imagename;
		}
		
		$client_profile->user_id = Auth::id();
		$client_profile->f_name = $request->f_name;
		$client_profile->l_name = $request->l_name;
		$client_profile->rut = $request->rut;
		$client_profile->birthday = $request->birthday;
		$client_profile->phone = $request->phone;
		$client_profile->gender = $request->gender;
		$client_profile->nationality = $request->nationality;
		$client_profile->comunity = $request->comunity;
		$client_profile->city = $request->city;
		$client_profile->street = $request->street;
		$client_profile->block = $request->block;
		$client_profile->about_me = $request->about_me;
		
		$client_profile->save();
		
		return back()->with('success', 'Datos personales actualizados con éxito');
	}
	
	/**
	 * Show the document list view
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function documents()
	{
		return view('documents', [
			'user' => Auth::user(),
			'my_documents' => Auth::user()->documents,
		]);
	}
	
	/**
	 * Show the Upload Document Form.
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function document_upload()
	{
		return view('document-upload', ['user' => Auth::user()]);
	}
	
	/**
	 * Receives the uploaded file from browser.
	 * Using Document Model store the file in server and register the 
	 * transaction in the documents table.
	 */
	public function document_add(Request $request)
	{
		$document = new Document;
		
		if ($request->file('document_image'))
		{
			$image = $request->file('document_image');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/uploads/');
			$image->move($destination_path, $imagename);
			
			$document->file_path = 'uploads/'.$imagename;
		}
		
		$document->fill($request->input())->save();
		
		return redirect()->route('user.documents')->with('success', 'Su documento ha sido registrado con éxito');
	}
	
	/**
	 * Show the document edit form
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function document_edit(Document $document)
	{
		return view('document-edit', [
			'user' => Auth::user(),
			'document' => $document
		]);
	}
	
	/**
	 * Update the given document
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function document_update(Request $request, Document $document)
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
		
		return redirect()->route('user.documents')->with('success', 'Su documento ha sido actualizado con éxito');
	}
	
	/**
	 * Delete the given document
	 * 
	 * @return Illuminate\Http\Response Response class instance
	 */
	public function document_delete(Document $document)
	{
		$document->delete();
		
		return back()->with('warning', 'Documento borrado con éxito');
	}
}
