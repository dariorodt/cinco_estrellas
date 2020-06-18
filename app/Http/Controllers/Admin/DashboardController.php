<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Worker;
use App\Application;
use App\Payment;

class DashboardController extends Controller
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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$new_clients = User::all()->filter(function($client) {
			if ($client->profile == null || $client->profile->status != 'active') return true;
		})->count();
		
		$new_workers = Worker::all()->filter(function($worker) {
			if ($worker->profile == null || $worker->profile->state != 'active') return true;
		})->count();
		
		$applications = Application::all()->count();
		
		$payments = Payment::all()->count();
		
		return view('admin.dashboard', compact('new_clients', 'new_workers', 'applications', 'payments'));
	}
	
	/**
	 * Show the welcome page content administration panel
	 * 
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function welcome()
	{
		$welcome_page_content = json_decode(Storage::get('welcome-page.json'));
		
		return view('admin.main-page-content', ['content' => $welcome_page_content,]);
	}
	
	
	public function welcome_store(Request $request)
	{
		$welcome_page_content = json_decode(Storage::get('welcome-page.json'));
		
		if($request->file('cover_image'))
		{
			$image = $request->file('cover_image');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/images/');
			$image->move($destination_path, $imagename);
			unlink(public_path($welcome_page_content->cover_image));
			$welcome_page_content->cover_image = 'images/'.$imagename;
		}
		
		$welcome_page_content->email = $request->email;
		$welcome_page_content->phone = $request->phone;
		$welcome_page_content->facebook = $request->facebook;
		$welcome_page_content->instagram = $request->instagram;
		$welcome_page_content->twitter = $request->twitter;
		$welcome_page_content->cover_title = $request->cover_title;
		$welcome_page_content->cover_message = $request->cover_message;
		$welcome_page_content->cover_link = $request->cover_link;
		$welcome_page_content->cover_link_text = $request->cover_link_text;
		
		Storage::put('welcome-page.json', json_encode($welcome_page_content, JSON_PRETTY_PRINT));
		
		return back();
	}
	
	/**
	 * Show the main page content administration panel
	 * 
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function services()
	{
		return view('admin.service-page-content');
	}
	
	/**
	 * Show the main page content administration panel
	 * 
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function howitworks()
	{
		$howitworks_page_content = json_decode(Storage::get('howitworks-page.json'));
		
		return view('admin.howitworks-page-content', [
			'content' => $howitworks_page_content
		]);
	}
	
	
	public function howitworks_store(Request $request)
	{
		$howitworks_page_content = json_decode(Storage::get('howitworks-page.json'));
		
		if($request->file('cta1_image'))
		{
			$image1 = $request->file('cta1_image');
			$imagename = time().'a.'.$image1->getClientOriginalExtension();
			$destination_path = public_path('/images/');
			$image1->move($destination_path, $imagename);
			//unlink(public_path($howitworks_page_content->cta1_image));
			$howitworks_page_content->cta1_image = 'images/'.$imagename;
		}
		
		if($request->file('cta2_image'))
		{
			$image2 = $request->file('cta2_image');
			$imagename = time().'b.'.$image2->getClientOriginalExtension();
			$destination_path = public_path('/images/');
			$image2->move($destination_path, $imagename);
			//unlink(public_path($howitworks_page_content->cta2_image));
			$howitworks_page_content->cta2_image = 'images/'.$imagename;
		}
		
		$howitworks_page_content->cta1_title = $request->cta1_title;
		$howitworks_page_content->cta2_title = $request->cta2_title;
		$howitworks_page_content->cta2_text = $request->cta2_text;
		$howitworks_page_content->cta2_btn_text = $request->cta2_btn_text;
		$howitworks_page_content->cta2_btn_link = $request->cta2_btn_link;
		
		Storage::put('howitworks-page.json', json_encode($howitworks_page_content, JSON_PRETTY_PRINT));
		
		return back();
	}
	
	/**
	 * Show the main page content administration panel
	 * 
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function contact()
	{
		$contact_help_text = Storage::get('contact-help.txt');
		
		return view('admin.contact-page-content', ['contact_help_text' => $contact_help_text]);
	}
	
	public function contact_edit()
	{
		$contact_help_text = Storage::get('contact-help.txt');
		
		return view('admin.contact-page-edit', ['contact_help_text' => $contact_help_text]);
	}
	
	public function contact_store(Request $request)
	{
		Storage::put('contact-help.txt', $request->text);
		
		return back();
	}
	
	/**
	 * Show the Privacy Policy text
	 * 
	 * @return Illuminate\Http\Response 
	 */
	public function privacy()
	{
		$privacy_policy_text = Storage::get('privacy-policy.txt');
		
		return view('admin.privacy-policy', [
			'privacy_policy_text' => $privacy_policy_text,
		]);
	}
	
	/**
	 * Show the text editor to edit privacy policy text
	 * 
	 * @return Illumunate\Http\Response
	 */
	public function privacy_edit()
	{
		$privacy_policy_text = Storage::get('privacy-policy.txt');

		return view('admin.privacy-edit', [
			'privacy_policy_text' => $privacy_policy_text,
		]);
	}
	
	/**
	 * Stores the text into a file.
	 * @param  Request $request
	 * @return Illuminate\Http\Response
	 */
	public function privacy_store(Request $request)
	{
		Storage::put('privacy-policy.txt', $request->text);
		
		return back();
	}
	
	/**
	 * Show the Tarms of Services text
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function terms()
	{
		$terms_conditions_text = Storage::get('terms-conditions.txt');
		
		return view('admin.terms-conditions', [
			'terms_conditions_text' => $terms_conditions_text,
		]);
	}
	
	/**
	 * Show the editor to edit the contract text
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function terms_edit()
	{
		$terms_conditions_text = Storage::get('terms-conditions.txt');
		
		return view('admin.terms-edit', [
			'terms_conditions_text' => $terms_conditions_text,
		]);
	}
	
	/**
	 * Store the contract text into a file
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function terms_store(Request $request)
	{
		Storage::put('terms-conditions.txt', $request->text);
		
		return back();
	}
}
