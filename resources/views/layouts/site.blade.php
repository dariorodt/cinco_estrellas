@php
	$content = json_decode(Illuminate\Support\Facades\Storage::get('welcome-page.json'));
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- CSRF Token --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

	{{-- Scripts --}}
	{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

	{{-- Fonts --}}
	{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
	
	{{-- Front-end styles --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/color-green.css') }}">
	<link rel="shortcut icon" href="{{ asset('images/short_icon.png') }}">
	
	{{-- RateIt CSS --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('rateit/rateit.css') }}">

	{{-- Styles --}}
	{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
	
	@yield('css')
</head>
<body>
	{{-- LOADER --}}
	<div class="loader">
		<div class="cssload-svg"><img src="{{ asset('images/42-3.gif') }}" alt="image"></div>
	</div>
	{{-- LOADER --}}

	{{-- HEADER --}}
	<header id="main_header_2">
		<div id="header-top">
			<div class="container">
				<div class="row">

					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="top-contact">
							<p>
								Consulta al: <span>{{ $content->phone }}</span> o escríbenos: <span><a href="mailto:{{ $content->email }}">{{ $content->email }}</a></span>
							</p>
						</div>
					</div>
					
					{{-- This for is needed to perform Logout due that the route expect a POST request --}}
					<form id="client-logout" action="{{ route('logout') }}" method="POST">@csrf</form>
					<form id="worker-logout" action="{{ route('worker.logout') }}" method="POST">@csrf</form>

					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="top_right_links2">
							<ul class="top_links">
								@auth('worker')
									<li><a href="{{ route('worker.dashboard') }}"><i class="fa fa-user-o" aria-hidden="true"></i> Mi Panel </a> </li>
									<li><a href="#" onclick="logout('worker-logout')"><i class="fa fa-sign-out"></i> Logout</a></li>
								@endauth
								@auth('web')
									<li><a href="{{ route('home') }}"><i class="fa fa-user-o" aria-hidden="true"></i> Mi Perfil</a> </li>
									<li><a href="#" onclick="logout('client-logout')"><i class="fa fa-sign-out"></i> Logout</a></li>
								@endauth
								@unless(Auth::guard('worker')->check() || Auth::guard('web')->check())
									<li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar</a> / <a href="{{ route('register') }}"><i class="fa fa-edit"></i> Registrar</a> </li>
								@endunless
							</ul>
							<div class="add-listing"> <a href="{{ route('user.order.create') }}" class="boton_sup"><i class="fa fa-plus" aria-hidden="true"></i> Solicitar Servicio</a> </div>
						</div>
					</div>
					<div class="top_right_links2-bg"></div>

				</div>
			</div>
		</div>
		<nav class="navbar navbar-default navbar-sticky bootsnav">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						{{-- Start Header Navigation --}}
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i>
							</button>
							<a class="navbar-brand sticky_logo" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" class="logo" alt="">
							</a>
						</div>
						{{-- End Header Navigation --}}
						<div class="collapse navbar-collapse" id="navbar-menu">
							<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
								<li id="start-menu"><a href="{{ url('/') }}">Inicio</a></li>
								<li id="services-menu"><a href="{{ url('services') }}">Servicios</a></li>
								<li id="how-it-works-menu"><a href="{{ url('how-it-works') }}">Cómo Funciona</a></li>
								<li id="worker-menu"><a href="{{ url('mission-vission') }}">Misión y Visión</a></li>
								<li id="contact-menu"><a href="{{ url('contact') }}">Ayuda</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	{{-- HEADER  --}}
	
	
	

	@yield('content')
	
	
	
	
	
	{{-- Footer --}}
	<footer id="footer_1" class="bg_blue p_t70 p_b30">
		<div class="container">
			<div class="row">

				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="footer_logo">
						<img src="{{ asset('images/logo-footer.png') }}" alt="image" />
					</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12 text-center">
					<ul class="footer_link">
						<li><a href="{{ url('/') }}">Inicio</a></li>
						<li><a href="{{ url('services') }}">Servicios</a></li>
						<li><a href="{{ url('how-it-works') }}">Cómo Funciona</a></li>
						<li><a href="{{ url('mission-vission') }}">Misión y Visión</a></li>
						<li><a href="{{ url('contact') }}">Contacto</a></li>
					</ul>
				</div>

				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="header-top-links">
						<div class="social-icons text-right">
							<ul>
								<li>
									<a href="{{ $content->facebook }}">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a href="{{ $content->instagram }}">
										<i aria-hidden="true" class="fa fa-instagram"></i>
									</a>
								</li>
								<li>
									<a href="{{ $content->twitter }}">
										<i class="fa fa-twitter" aria-hidden="true"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="footer_line"></div>
		</div>

		<div class="footer_botom">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-6 col-sm-12">
						<p>Copyrights © 2019 Cinco Estrellas. Todos los derechos.</p>
					</div>
					<div class="col-md-6 col-md-6 col-sm-12 text-right">
						<p>Desarrollo por <a href="https://www.kewey.cl">Ke Wey Marketing</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		
	</footer>
	{{-- Footer --}}
	
	<script src="{{ asset('js/jquery.2.2.3.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.appear.js') }}"></script>
	<script src="{{ asset('js/jquery-countTo.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
	<script src="{{ asset('js/bootsnav.js') }}"></script>
	<script src="{{ asset('js/zelect.js') }}"></script>
	<script src="{{ asset('js/dropzone.min.js') }}"></script>
	<script src="{{ asset('js/parallax.min.js') }}"></script>
	<script src="{{ asset('js/modernizr.custom.26633.js') }}"></script>
	<script src="{{ asset('js/jquery.gridrotator.js') }}"></script>
	<script src="{{ asset('js/functions.js') }}"></script>
	<script src="{{ asset('rateit/jquery.rateit.js') }}"></script>
	
	<!-- Jivo Chat Widget -->
	{{-- <script src="//code.jivosite.com/widget.js" data-jv-id="fUjwTe3jcp" async></script> --}}
	
	<!-- Facebook Pixel Code -->
	{{-- <script>
		!function(f,b,e,v,n,t,s) {
			if(f.fbq) return;
			n = f.fbq = function() {
				n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)
			};
			if(!f._fbq) f._fbq=n;
			n.push=n;
			n.loaded=!0;
			n.version='2.0';
			n.queue=[];
			t=b.createElement(e);
			t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)
		}(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '435588213978877'); 
		fbq('track', 'PageView');
	</script> --}}
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-147730251-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-147730251-1');
	</script> --}}
	
	<noscript>
		<img height="1" width="1" 
		src="https://www.facebook.com/tr?id=435588213978877&ev=PageView
		&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	
	<script>
		function logout(form) {
			console.log('Logging out');
			document.getElementById(form).submit();
		}
	</script>
	
	@yield('scripts')
	
</body>
</html>
