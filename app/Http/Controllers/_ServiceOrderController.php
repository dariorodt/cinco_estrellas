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
		$configuration->setEnvironment("PRODUCCION");
		$configuration->setCommerceCode(597034940126);
		$configuration->setPrivateKey(
			"-----BEGIN RSA PRIVATE KEY-----\n".
			"MIIEpQIBAAKCAQEA6mE/cimjCe6u9yVPmzd55eNjACNJBMqUj6KMts7iZUUmcj2i\n".
			"gZg/TMIDLqArWYklhiixvK4Z1r9JX0xucOhdrFQ7FAzY+11AFFK5aMI/rbwk36+d\n".
			"DWvi+JP1mvn5K1pb/4JXmOCzvwBJMgxYFiVNrdvPpgQEFiTfy27nJ0JeHAyMwIl1\n".
			"5WdJPAfngeQsB03oqYIC2qM1UGDKGJRuriY6ODoadpEzcFO1d3wp1TfK2iktiN1p\n".
			"E7OObpEkIoZhS4hJzBFhKeP+xloinyLDUtALoLYzibPWpmBj8hZ53F5fpaV4ue0K\n".
			"cg9CFvChNU/TwBGt/rzzDyIfOjYUfeTihPcNBQIDAQABAoIBAQCQEjkq1tdGeraI\n".
			"ayH0+nPu0QiBBC+VR2VsqXGvyZo2v/vzC1oCKXD3oObN2VzsS7aKMieXILn3XFwg\n".
			"vV3B/8Pc82XhXEhgsyB5naQk9gqoo9dSvKNgpam+PU0i93eno4KbnCZ2beFvjiBw\n".
			"KFBZRJLsRQruNNfCOOZsKX7jjhNFT3BjKwpKBDADfpTrcZqaijvwT/ylR3OHl2pz\n".
			"VmgAMxq2I0WYh0uRlf7hj4WP1+XTjmccmKXI2NIa8v5bY58GTC4qArsB5NjU7uHK\n".
			"FFsQIQmo7xHM1ajrZEKuEEYZZepCH8QXFMQ5gGagMvo14qN1IDwoiJ16TZ032qk2\n".
			"XaLr98+hAoGBAPjmRripk7zkSqCjJBaZgoR5bgjpqTWHeZHttCGbFqSho0AwA5KR\n".
			"FaEIPqZx3TVaY9meQl/cdwE/Pd7xRNGBYUqN/Z3o84HWEfRE8DQTAJAMLCaEAxpT\n".
			"J/tjcx1niBCPiyC7LxZBhr2btMQB598n5r2+P33K/RQVcUd4GON3uMVZAoGBAPEQ\n".
			"7xuu/w8OFzgM/YVXSx/lf9349R0UbE5cGCttv5q3B71YBEbdUD0YSTsGSTf3qFVT\n".
			"wjxhf3kwIbbWfEHzgE9KreV56rG8Ky+souqgiPp6VYfg8ccddU/HLshhd8Wbp1Jn\n".
			"ZhqvTlbWg/5xd54e7y1HHPYnN6jYhosRGlXimtONAoGBAN2cqvtggZp96bR9jXRR\n".
			"2lP5im+FHJP8u9Giw+/oFpEfGivclFG7vHZU0POCDmOix6TLtG2F7q+9j2khiRTB\n".
			"Dc9D/bzL3YSNBg9oEjdLdATN0cG5aMnXoJHESoqz1AJqzIWoJJS8YywPpzOePsYC\n".
			"0P/AlOd8BToMnX/0/rQJtQqBAoGBAPDrRJv9K2kHYwsgaGpPkIPjIAReH9GdLJSv\n".
			"k3QrrbbYvwJrKXMNEXjNgbpckOY/O1tzZwZjRjt+b+NDvlFHIu+bqelSC8zvSpXN\n".
			"ydAE+oChrEMs+1VMyoYdgVK/niy+X92J+tAmbXt5zdaH3c0IC27LyFT1Yrn7E5N+\n".
			"VzyISMWtAoGAe8rcTMSze3wLzQCZFupHB46FGwl2S95MUgbblvZYarSfp89THht3\n".
			"xz5d3rGMEWGF67E342Ny8YituWrJK3roW10hEFYe/4Y6sm5DUgLPMO+EWQTtBuPn\n".
			"fzjkRsfW9jtFKrhURvHcOrkl9Ag/E2iuMVIW51W7rGivTfJ1pJWO3hA=\n".
			"-----END RSA PRIVATE KEY-----\n"
		);
		$configuration->setPublicCert(
			"-----BEGIN CERTIFICATE-----\n".
			"MIIDNDCCAhwCCQCnNbo1F/MmBzANBgkqhkiG9w0BAQsFADBcMQswCQYDVQQGEwJD\n".
			"TDETMBEGA1UECAwKU29tZS1TdGF0ZTEhMB8GA1UECgwYSW50ZXJuZXQgV2lkZ2l0\n".
			"cyBQdHkgTHRkMRUwEwYDVQQDDAw1OTcwMzQ5NDAxMjYwHhcNMTkxMTE3MDIzMTUw\n".
			"WhcNMjMxMTE2MDIzMTUwWjBcMQswCQYDVQQGEwJDTDETMBEGA1UECAwKU29tZS1T\n".
			"dGF0ZTEhMB8GA1UECgwYSW50ZXJuZXQgV2lkZ2l0cyBQdHkgTHRkMRUwEwYDVQQD\n".
			"DAw1OTcwMzQ5NDAxMjYwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDq\n".
			"YT9yKaMJ7q73JU+bN3nl42MAI0kEypSPooy2zuJlRSZyPaKBmD9MwgMuoCtZiSWG\n".
			"KLG8rhnWv0lfTG5w6F2sVDsUDNj7XUAUUrlowj+tvCTfr50Na+L4k/Wa+fkrWlv/\n".
			"gleY4LO/AEkyDFgWJU2t28+mBAQWJN/LbucnQl4cDIzAiXXlZ0k8B+eB5CwHTeip\n".
			"ggLaozVQYMoYlG6uJjo4Ohp2kTNwU7V3fCnVN8raKS2I3WkTs45ukSQihmFLiEnM\n".
			"EWEp4/7GWiKfIsNS0AugtjOJs9amYGPyFnncXl+lpXi57QpyD0IW8KE1T9PAEa3+\n".
			"vPMPIh86NhR95OKE9w0FAgMBAAEwDQYJKoZIhvcNAQELBQADggEBAK2BKLoyyDiY\n".
			"WycegBmI0sEqjlTrRs+RfgDrTCI5VVi2eEki5kAdkZsXSdt2NA8hiqbE3bfxK6ZX\n".
			"rGTtoVw2SVrcA6T+oaatyx/ZQ28brr6OE6EnHqNIUO0s6j2pDm2tcEornKjjWIQo\n".
			"p6rxC8ukztDK8LZGbgMA4NFToeTEdeiaK5wfnfq5AVPQOQHqXWPgIOhplAfqdAk6\n".
			"Z5vU7C8F6rnxJhNxka6rsUd/hPKC9l/GiUSLpkb+STSmXyi1xFj4R9uEAZuNg62e\n".
			"3LH26ssAoUgP1oXbwTvxGEqgyLUvnJGYLduWPhXRbuwT2CVVK8myy+BKiTtlurgM\n".
			"Y8SwZ/AGWFU=\n".
			"-----END CERTIFICATE-----\n"
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
			"-----END CERTIFICATE-----\n"
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
		
		$form_action = $init_result->url;

		$token = $init_result->token;
		
		return view('checkout', [
			'order' => $order,
			'worker' => $worker,
			'worker_service' => $worker_service,
			'amount' => $amount,
			'days' => $days,
			'form_action' => $form_action,
			'token' => $token,
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
		
		return redirect()->route('user.orders')->with('success', 'Su orden de servicio se actualizó correctamente.');
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
