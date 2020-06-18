<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class WorkerLoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/worker/dashboard';
	
	/**
	 * Since this Controller belongs to Worker class we have to change 
	 * the guard to «worker»
	 * 
	 * @var string 
	 */
	protected $guard = 'worker';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}
	
	/**
	 * Show the admin's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm()
	{
		return view('auth.worker-login');
	}
	
	/**
	 * Performs the login operation
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function login(Request $request)
	{
		// Ver minuto 14:50 del seguno vídeo de BroCodeomAttributes);
		
		// $this->validate() returns an assocc-array with the users credentials.
		// It means «email», «password»
		$credentials = $this->validate($request, [
			'email'    => 'required|email',
			'password' => 'required|min:6|string'
		]);
		
		
		// Sice this function is intended to login workers only the guard
		// should be redirected to worker guard
		if(Auth::guard('worker')->attempt($credentials, $request->remember))
		{
			return redirect()->route('worker.dashboard');
		}
		
		return redirect()->back()->withInput($credentials);
	}

	/**
	 * Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request)
	{
		// When I tried to logout after logging in with remember_token, a weird effect occurred.
		// The logout took effect but the browser still remembered the user...
		// That was because remember_token field remains undeleted.
		// The solution was to delete remember_token manually.
		$user = Auth::guard('worker')->user();
		$user->remember_token = NULL;
		$user->save();
		
		$this->guard('worker')->logout();

		$request->session()->invalidate();

		return $this->loggedOut($request) ?: redirect('/');
	}
}
