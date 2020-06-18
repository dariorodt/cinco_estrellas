<?php

/******************************************************************************

	Class:		WebPayController
	Extends:	Controller
	
	This Controller receives the WebPay Service API responses and takes the 
	corresponding actions depending on whether the response is successful or 
	error.
	If success, it register the payment in the database and the webpay.log 
	file

******************************************************************************/

namespace App\Http\Controllers;

// Laravel Framework
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// App Models
use App\ServiceOrder;
use App\Worker;
use App\Payment;
// WebPay SDK
use \Transbank\Webpay\Webpay;
use \Transbank\Webpay\Configuration;
// Notifications
use App\Notifications\HaveBeenHired;

class WebPayController extends Controller
{
	/**
	 * Get back the WebPay response after make payment.
	 * 
	 * @param  Request      $request
	 * @param  ServiceOrder $order
	 * @param  Worker       $worke
	 * @return void
	 */
	public function return(Request $request, ServiceOrder $order, Worker $worker)
	{
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

		// Recupera el token del cuerpo de la petición POST (Aquí sólo viene el token y nada más)
		$token_ws = $request->token_ws;

		// Usando el token como referencia, recupera los resultados de la transacción.
		$result = $transaction->getTransactionResult($token_ws);
		
		// Log the transaction
		Storage::append('webpay.log', Carbon::now().'- Server response -> '.$token_ws.' -> '.json_encode($result));

		$output = $result->detailOutput;
		$card_detail = $result->cardDetail;
		
		// If error...
		
		// Stops the transaction and notify the user.
		if ($output->responseCode < 0) {
			return redirect()->route('user.order.payment_error', $order);
		}
		
		// If success...
		
		// Register the payment.
		Payment::create([
			'user_id'            => $order->user_id,
			'worker_id'          => $worker->id,
			'order_id'           => $order->id,
			'token_ws'           => $token_ws,
			'authorization_code' => $output->authorizationCode,
			'payment_type'       => $output->paymentTypeCode,
			'shares_amount'      => $output->paymentTypeCode == 'NC' ? $output->sharesAmount : 0,
			'shares_number'      => $output->paymentTypeCode == 'NC' ? $output->sharesNumber : 0,
			'payment_date'       => Carbon::now(),
			'card_number'        => $card_detail->cardNumber,
			'card_expire_date'   => $card_detail->cardExpirationDate,
			'worker_paid'        => false,
			'amount'             => $output->amount,
		]);
		
		// Register the hiring service order level.
		$order->worker_id = $worker->id; 
		$order->status = 'active';
		$order->save();
		
		// Notify Client and Worker.
		//$order->client->notify(new HaveBeenHired($order));
		return view('webpay-return', [
			'url_redirection' => $result->urlRedirection,
			'token_ws' => $token_ws,
		]);
	}
	
	/**
	 * This function redirects the user to the payment
	 * 
	 * @param  Request      $request 
	 * @param  ServiceOrder $order   
	 * @param  Worker       $worker  
	 * @return void
	 */
	public function final(Request $request, ServiceOrder $order, Worker $worker)
	{
		return redirect()->route('user.payments')->with('success', 'Su pago ha sido registrado con éxito');
	}
}
