<?php

/******************************************************************************

	Class:		ServiceOrderController
	Extends:	Controller
	
	This Contoller is intended to manage the Service Orders from client 
	persepctive. It's about list, generate, register, modify (while not active 
	or closed) and delete (while not active or closed), and excecute the 
	Payment Procedure via the TransBank WebPay Normal Service, configuring 
	the payment transaction and sending it through the WebPay API.
	
	The response coming from WebPay Server is managed by WepPayController 
	class.

******************************************************************************/

namespace App\Http\Controllers;

// Laravel framework
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
// App model
use App\ServiceOrder;
use App\Service;
use App\Worker;
// WebPay SDK
use \Transbank\Webpay\Webpay;
use \Transbank\Webpay\Configuration;
// Notifications
use App\Notifications\JobPosted;
use App\Notifications\RememberRate;

class ServiceOrderController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->Config = json_decode(Storage::get('app-config.json'));
	}
	
	/**
	 * Show The Service Orders committed by authenticated user
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\ApplicationReceived') as $notification) {
			$notification->markAsRead();
		}
		
		return view('orders', [
			'user' => Auth::user(),
			'orders' => Auth::user()->service_orders,
		]);
	}
	
	/**
	 * Show the new-service-form view
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function create()
	{
		return view('order-create', [
			'user'     => Auth::user(),
			'services' => Service::all()
		]);
	}
	
	/**
	 * Store a new service order
	 * 
	 * @param  Request
	 * @return Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$start_date = date('Y-m-d', strtotime(str_replace('/', '-', substr($request->daterange, 0, 10))));
		// $today = new Carbon("now", 'America/Caracas');
		$today = new Carbon("now");
		
		$date_diff = $today->diffInDays($start_date);
		
		// Trapp the is_express field in a boolean variable.
		$is_express = $request->is_express? true:false;
		
		if (!$is_express && $date_diff < 2)
			return back()
				->withErrors(['daterange' => 'La contratación debe hacerse con 72 horas de anticipación'])
				->withInput();
		
		$service_order = ServiceOrder::create([
			'user_id' => Auth::id(),
			'worker_id' => null,
			'admin_id' => null,
			'service_id' => $request->service,
			'is_express' => $is_express,
			'starting_date' => date('Y-m-d', strtotime(str_replace('/', '-', substr($request->daterange, 0, 10)))),
			'ending_date' => date('Y-m-d', strtotime(str_replace('/', '-', substr($request->datarange, 0, -10)))),
			'starting_time' => $request['start-time'],
			'ending_time' => $request['finish-time'],
			'region' => $request->region,
			'comunity' => $request->community,
			'city' => $request->city,
			'aditional_info' => $request->aditional_info
		]);
		
		// Find and notify all workers that can apply
		$notifiable_workers = Service::find($request->service)->workers;
		Notification::send($notifiable_workers, new JobPosted($service_order));
		
		return redirect()->route('user.orders')->with('success', 'Su orden de servicio se publicó con éxito.');
	}
	
	/**
	 * @param  ServiceOrder
	 * @return Illuminate\Http\Response
	 */
	public function edit(ServiceOrder $order)
	{	
		return view('order-edit', [
			'order'    => $order,
			'user'     => Auth::user(),
			'services' => Service::all(),
			'express_percentage' => $this->Config->express_percentage,
		]);
	}
	
	/**
	 * Show a warning if any error occurs while pying.
	 * 
	 * @param  ServiceOrder $order
	 * @return Illuminate\Http\Response
	 */
	public function payment_error(ServiceOrder $order)
	{
		return redirect()->route('user.order.edit', $order)->with('warning', 'Su tarjeta ha sido rechazada. Diríjase al emisor.');
	}
	
	/**
	 * Init the WebPay payment procedure.
	 * 
	 * @param  ServiceOrder $order
	 * @param  Worker       $worker
	 * @return void
	 */
	public function hire(ServiceOrder $order, Worker $worker)
	{
		
		// Reject action if order owner is not authenticated or if order is 
		// already processed.
		if ($order->client->id !== Auth::id() || $order->status !== 'open') {
			return redirect('home');
		}
		
		// Get the job period in days and daily cost
		$starting_date = new Carbon($order->starting_date);
		$days = $starting_date->diffInDays(Carbon::create($order->ending_date));
		$worker_service = $worker->services->find($order->service_id);
		$cost = $worker_service->pivot->day_cost;
		
		// Set configuration class
		$configuration = new Configuration();
		$configuration->setEnvironment("INTEGRACION");
		// $configuration->setCommerceCode(597034940126);
		$configuration->setCommerceCode(597020000540);
		$configuration->setPrivateKey(
			"-----BEGIN RSA PRIVATE KEY-----\n".
			"MIIEowIBAAKCAQEAvuNgBxMAOBlNI7Fw5sHGY1p6DB6EMK83SL4b1ZILSJs/8/MC\n".
			"X8Pkys3CvJmSIiKU7fnWkgXchEdqXJV+tzgoED/y99tXgoMssi0ma+u9YtPvpT7B\n".
			"a5rk5HpLuaFNeuE3l+mpkXDZZKFSZJ1fV/Hyn3A1Zz+7+X2qiGrAWWdjeGsIkz4r\n".
			"uuMFLQVdPVrdAxEWoDRybEUhraQJ1kwmx92HFfRlsbNAmEljG9ngx/+/JLA28cs9\n".
			"oULy4/M7fVUzioKsBJmjRJd6s4rI2YIDpul6dmgloWgEfzfLNnAsZhJryJNBr2Wb\n".
			"E6DL5x/U2XQchjishMbDIPjmDgS0HLLMjRCMpQIDAQABAoIBAEkSwa/zliHjjaQc\n".
			"SRwNEeT2vcHl7LS2XnN6Uy1uuuMQi2rXnBEM7Ii2O9X28/odQuXWvk0n8UKyFAVd\n".
			"NSTuWmfeEyTO0rEjhfivUAYAOH+coiCf5WtL4FOWfWaSWRaxIJcG2+LRUGc1WlUp\n".
			"6VXBSR+/1LGxtEPN13phY0DWUz3FEfGBd4CCPLpzq7HyZWEHUvbaw89xZJSr/Zwh\n".
			"BDZZyTbuwSHc9X9LlQsbaDuW/EyOMmDvSxmSRJO10FRMxyg8qbE4edtUK4jd61i0\n".
			"kGFqdDu9sj5k8pDxOsN2F270SMlIwejZ1uunB87w9ezIcR9YLq9aa22cT8BZdOxb\n".
			"uZ3PAAECgYEA6xfgRtcvpJUBWBVNsxrSg6Ktx2848eQne9NnbWHdZuNjH8OyN7SW\n".
			"Fn0r4HsTw59/NJ1L5F3co5L5baEtRbRLWRpD72xjrXsQSsoKliCik1xgDIplMvOh\n".
			"teA2GdeSv9wglqnotGcj5B/8+vn3tEzMjy+UUsyFn0fIaDC3zK3W2qUCgYEAz90g\n".
			"va+FCcU8cnykb5Yn1u1izdK1c6S++v1bQFf6590ZMNy3p0uGrwAk/MzuBkJ421GK\n".
			"p4pInUvO/Mb2BCcoHtr3ON3v0DCLl6Ae2Gb7lG0dLgcZ1EK7MDpMvKCqNHAv8Qu8\n".
			"QBZOA08L8buVkkRt7jxJrPuOFDI5JAaWCmMOSgECgYEA3GvzfZgu9Go862B2DJL+\n".
			"hCuYMiCHTM01c/UfyT/z/Y7/ln2+8FniS02rQPtE6ar28tb0nDahM8EPGon/T5ae\n".
			"+vkUbzy6LKLxAJ501JPeurnm2Hs+LUqe+U8yioJD9p2m9Hx0UglOborLgGm0pRlI\n".
			"xou+zu8x7ci5D292NXNcun0CgYAVKV378bKJnBrbTPUwpwjHSMOWUK1IaK1IwCJa\n".
			"GprgoBHAd7f6wCWmC024ruRMntfO/C4xgFKEMQORmG/TXGkpOwGQOIgBme+cMCDz\n".
			"xwg1xCYEWZS3l1OXRVgqm/C4BfPbhmZT3/FxRMrigUZo7a6DYn/drH56b+KBWGpO\n".
			"BGegAQKBgGY7Ikdw288DShbEVi6BFjHKDej3hUfsTwncRhD4IAgALzaatuta7JFW\n".
			"NrGTVGeK/rE6utA/DPlP0H2EgkUAzt8x3N0MuVoBl/Ow7y5sqIQKfEI7h0aRdXH5\n".
			"ecefOL6iiJWQqX2+237NOd0fJ4E1+BCMu/+HnyCX+cFM2FgoE6tC\n".
			"-----END RSA PRIVATE KEY-----"
		);
		$configuration->setPublicCert(
			"-----BEGIN CERTIFICATE-----\n".
			"MIIDeDCCAmACCQDjtGVIe/aeCTANBgkqhkiG9w0BAQsFADB+MQswCQYDVQQGEwJj\n".
			"bDENMAsGA1UECAwEc3RnbzENMAsGA1UEBwwEc3RnbzEMMAoGA1UECgwDdGJrMQ0w\n".
			"CwYDVQQLDARjY3JyMRUwEwYDVQQDDAw1OTcwMjAwMDA1NDAxHTAbBgkqhkiG9w0B\n".
			"CQEWDmNjcnJAZ21haWwuY29tMB4XDTE4MDYwODEzNDYwNloXDTIyMDYwNzEzNDYw\n".
			"NlowfjELMAkGA1UEBhMCY2wxDTALBgNVBAgMBHN0Z28xDTALBgNVBAcMBHN0Z28x\n".
			"DDAKBgNVBAoMA3RiazENMAsGA1UECwwEY2NycjEVMBMGA1UEAwwMNTk3MDIwMDAw\n".
			"NTQwMR0wGwYJKoZIhvcNAQkBFg5jY3JyQGdtYWlsLmNvbTCCASIwDQYJKoZIhvcN\n".
			"AQEBBQADggEPADCCAQoCggEBAL7jYAcTADgZTSOxcObBxmNaegwehDCvN0i+G9WS\n".
			"C0ibP/PzAl/D5MrNwryZkiIilO351pIF3IRHalyVfrc4KBA/8vfbV4KDLLItJmvr\n".
			"vWLT76U+wWua5OR6S7mhTXrhN5fpqZFw2WShUmSdX1fx8p9wNWc/u/l9qohqwFln\n".
			"Y3hrCJM+K7rjBS0FXT1a3QMRFqA0cmxFIa2kCdZMJsfdhxX0ZbGzQJhJYxvZ4Mf/\n".
			"vySwNvHLPaFC8uPzO31VM4qCrASZo0SXerOKyNmCA6bpenZoJaFoBH83yzZwLGYS\n".
			"a8iTQa9lmxOgy+cf1Nl0HIY4rITGwyD45g4EtByyzI0QjKUCAwEAATANBgkqhkiG\n".
			"9w0BAQsFAAOCAQEAhX2/fZ6+lyoY3jSU9QFmbL6ONoDS6wBU7izpjdihnWt7oIME\n".
			"a51CNssla7ZnMSoBiWUPIegischx6rh8M1q5SjyWYTvnd3v+/rbGa6d40yZW3m+W\n".
			"p/3Sb1e9FABJhZkAQU2KGMot/b/ncePKHvfSBzQCwbuXWPzrF+B/4ZxGMAkgxtmK\n".
			"WnWrkcr2qakpHzERn8irKBPhvlifW5sdMH4tz/4SLVwkek24Sp8CVmIIgQR3nyR9\n".
			"8hi1+Iz4O1FcIQtx17OvhWDXhfEsG0HWygc5KyTqCkVBClVsJPRvoCSTORvukcuW\n".
			"18gbYO3VlxwXnvzLk4aptC7/8Jq83XY8o0fn+A==\n".
			"-----END CERTIFICATE-----"
		);
		$configuration->setWebpayCert(
			"-----BEGIN CERTIFICATE-----\n".
			"MIIDizCCAnOgAwIBAgIJAIXzFTyfjyBkMA0GCSqGSIb3DQEBCwUAMFwxCzAJBgNV\n".
			"BAYTAkNMMQswCQYDVQQIDAJSTTERMA8GA1UEBwwIU2FudGlhZ28xEjAQBgNVBAoM\n".
			"CXRyYW5zYmFuazEMMAoGA1UECwwDUFJEMQswCQYDVQQDDAIxMDAeFw0xODAzMjkx\n".
			"NjA4MjhaFw0yMzAzMjgxNjA4MjhaMFwxCzAJBgNVBAYTAkNMMQswCQYDVQQIDAJS\n".
			"TTERMA8GA1UEBwwIU2FudGlhZ28xEjAQBgNVBAoMCXRyYW5zYmFuazEMMAoGA1UE\n".
			"CwwDUFJEMQswCQYDVQQDDAIxMDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoC\n".
			"ggEBAKRqDk/pv8GeWnEaTVhfw55fThmqbFZOHEc/Un7oVWP+ExjD0kZ/aAwMJZ3d\n".
			"9hpbBExftjoyJ0AYKJXA2CyLGxRp30LapBa2lMehzdP6tC5nrCYbDFz8r8ZyN/ie\n".
			"4lBQ8GjfONq34cLQfM+tOxyazgDYRnZVD9tvOcqI5bFwFKqpn/yMr9Eya7gTo/OP\n".
			"wyz69sAF8MKr0YN941n6C1Cdrzp6cRftdj83nlI75Ue//rMYih/uQYiht4XWFjAA\n".
			"usoOG/IVVCCHhVQGE/Rp22dAF8JzWYZWCe+ICOKjEzEZPjDBqPoh9O+0eGTFVwn2\n".
			"qZf2iSLDKBOiha1wwzpTiiJV368CAwEAAaNQME4wHQYDVR0OBBYEFDfN1Tlj7wbn\n".
			"JIemBNO1XrUOikQpMB8GA1UdIwQYMBaAFDfN1Tlj7wbnJIemBNO1XrUOikQpMAwG\n".
			"A1UdEwQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBACzXPSHet7aZrQvMUN03jOqq\n".
			"w37brCWZ+L/+pbdOugVRAQRb2W+Z6gyrJ2BuUuiZLCXpjvXACSpwcSB3JesWs9KE\n".
			"YO8E8ofF7a6ORvi2Mw0vpBbwJLqnci1gVlAj3X8r/VbX2rGbvRy+BJAF769xr43X\n".
			"dtns0JIWwKud0xC3iRPMnewo/75HIblbN3guePfouoR2VgfBmeU72UR8O+OpjwbF\n".
			"vpidobGqTGvZtxRV5axer69WY0rAXRhTSfkvyGTXERCJ3vdsF/v9iNKHhERUnpV6\n".
			"KDrfvgD9uqWH12/89hfsfVN6iRH9UOE+SKoR/jHtvLMhVHpa80HVK1qdlfqUTZo=\n".
			"-----END CERTIFICATE-----"
		);
		
		// Instatiate the WebPay class
		$transaction = (new WebPay($configuration))->getNormalTransaction();
		
		// Prepare all parameters needed to proseed with WebPay transaction
		$amount = $cost * ($days + 1);
		$session_id = session()->getId();
		$buy_order = $order->id;
		$return_url = route('webpay.return', [$order, $worker]);
		$final_url = route('webpay.final', [$order, $worker]);
		
		// Get the transaction results...
		$init_result = $transaction->initTransaction($amount, $buy_order, $session_id, $return_url, $final_url);
		
		// Log the transaction
		Storage::append('webpay.log', Carbon::now().' - transaction initiated -> '.json_encode($init_result));
		
		return view('checkout', [
			'order' => $order,
			'worker' => $worker,
			'worker_service' => $worker_service,
			'amount' => $amount,
			'days' => $days,
			'form_action' => $init_result->url,
			'token' => $init_result->token,
		]);
	}
	
	/**
	 * @param  Request
	 * @param  ServiceOrder
	 * @return Illuminate\Http\Response
	 */
	public function update(Request $request, ServiceOrder $order)
	{
		$order->starting_date = date('Y-m-d', strtotime(str_replace('/', '-', substr($request->daterange, 0, 10))));
		$order->ending_date = date('Y-m-d', strtotime(str_replace('/', '-', substr($request->daterange, -10))));
		$order->starting_time = $request->starting_time;
		$order->ending_time = $request->ending_time;
		$order->region = $request->region;
		$order->comunity = $request->community;
		$order->city = $request->city;
		$order->aditional_info = $request->aditional_info;
		
		
		$order->save();
		
		return redirect()
			->route('user.orders')
			->with('success', 'Su orden de servicio se actualizó correctamente.');
	}
	
	/**
	 * Deletes a service order as long as they have open or canceled status.
	 * Otherwise, they cannot be deleted and user should be notified.
	 * 
	 * @param  ServiceOrder
	 * @return Illumintate\Http\Response
	 */
	public function delete(ServiceOrder $order)
	{
		if ($order->status == 'open' || $order->status == 'canceled') {
			$order->delete();
			return redirect()->route('user.orders')->with('success', 'Su orden de servicio se eliminó con éxito.');
		}
		elseif ($order->status == 'active' || $order->status == 'closed') {
			$status = $order->status == 'active' ? 'abierta' : 'cerrada' ;
			return back()->with('warning', 'La orden no se puede eliminar porque su estado es '.$status);
		}
	}
	
	/**
	 * Change the Service Order status to close
	 * 
	 * @param  Request      $request
	 * @param  ServiceOrder $order
	 * @return Response
	 */
	public function close(Request $request, ServiceOrder $order)
	{
		// Change order status to close
		$order->status = 'closed';
		$order->save();
		
		// Notify the client and worker to rate each other
		$order->client->notify(new RememberRate($order));
		$order->worker->notify(new RememberRate($order));
		
		return back()->with('success', 'Orden '.$order->id.' cerrada correctamente');
	}
	
	/**
	 * Cancels a service order as long as it has open status.
	 * WARNING! This action will delete applications related to the given service order.
	 * 
	 * @param  Request      $request
	 * @param  ServiceOrder $order
	 * @return Response
	 */
	public function cancel(Request $request, ServiceOrder $order)
	{
		if ($order->status == 'open') {
			foreach ($order->applications as $application) {
				$application->delete();
			}
			$order->status = 'canceled';
			$order->save();
			return redirect()->route('user.orders')->with('warning', 'Orden cancelada');
		} else {
			return back()->with('warning', 'Sólo puede cancelar una orden si está abierta, las ordenes activas o cerradas no se pueden cancelar.');
		}
	}
	
	// TODO: public function reopen() { // NOTE: When reopening a service order, make sure the user adjust the dates after change the order status to open }
}
