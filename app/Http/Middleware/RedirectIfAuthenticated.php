<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		// if (Auth::guard($guard)->check()) {
		//     return redirect('/home');
		// }

		// return $next($request);
		
		switch ($guard)
		{
			case 'worker':
				if (Auth::guard($guard)->check())
				{
					return redirect()->route('worker.dashboard');
				}
			
			case 'admin':
				if (Auth::guard($guard)->check())
				{
					return redirect()->route('admin.dashboard');
				}
				break;
			
			default:
				if (Auth::guard($guard)->check())
				{
					return redirect('/home');
				}
		}
		
		return $next($request);
	}
}
