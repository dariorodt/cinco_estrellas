<?php

namespace App\Http\Controllers;
// Framework
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// Model
use App\Worker;
use App\WorkerRating;
use App\Service;

class SiteController extends Controller
{
	public function index()
	{
		$services = Service::all();
		
		$workers = Worker::all();
		$higer_ratings = WorkerRating::all()->sortByDesc('stars')->unique('worker_id')->slice(0, 6);
		$welcome_page_content = json_decode(Storage::get('welcome-page.json'));
		
		return view('welcome', [
			'workers' => $workers,
			'higer_ratings' => $higer_ratings,
			'content' => $welcome_page_content,
			'services' => $services,
		]);
	}
	
	/**
	 * Show the services page of the public site
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function services()
	{
		// $services = Service::all()->random(10);
		$services = Service::all();
		
		return view('services', ['services' => $services]);
	}
	
	/**
	 * Show the about page of the public site
	 * 
	 * @return ILluminate\Http\Response
	 */
	public function about()
	{
		$howitworks_page_content = json_decode(Storage::get('howitworks-page.json'));
		
		return view('about', ['content' => $howitworks_page_content]);
	}
	
	/**
	 * Show the Offer page of the public site
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function offer()
	{
		return view('offer');
	}
	
	/**
	 * Shows Contact page of the public site
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function contact()
	{
		$contact_help_text = Storage::get('contact-help.txt');
	
		return view('contact', ['contact_help_text' => $contact_help_text]);
	}
	
	/**
	 * Shows the Private Policy Contract page in the public site
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function privacy()
	{
		$privacy_policy = Storage::get('privacy-policy.txt');
		
		return view('privacy-policy', ['privacy_policy' => $privacy_policy]);
	}
	
	/**
	 * Shows the Tenrms and Conditions Contract page in the public site
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function terms()
	{
		$terms_conditions = Storage::get('terms-conditions.txt');
		
		return view('terms-conditions', [
			'terms_conditions' => $terms_conditions,
		]);
	}
	
	public function mission_vission()
	{
		$mission_text = Storage::get('mission.txt');
		$vission_text = Storage::get('vission.txt');
		
		return view('mission-vission', [
			'mission_text' => $mission_text,
			'vission_text' => $vission_text,
		]);
	}
}
