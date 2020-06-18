@php
	$content = json_decode(Illuminate\Support\Facades\Storage::get('welcome-page.json'));
@endphp

@extends('layouts.site')

@section('title', 'Registro de Trabajador')

@section('content')
	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Entrar / Registrar</h2>
						<p><a href="index.html">Inicio</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Entrar / Registrar</p>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Popular Listing -->
	<section id="login-register" class="p_b70 p_t70">
		{{-- <div class="container">
			<div class="row">
				<div class="col-md-12">
					@if ($errors)
						@foreach ($errors->all() as $message)
							<div class="alert alert-warning">
								{{ $message }}
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div> --}}

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">
							<a href="#login" aria-controls="login" role="tab" data-toggle="tab">Iniciar Sesión</a>
						</li>
						<li role="presentation" class="active">
							<a href="#registerd" aria-controls="registerd" role="tab" data-toggle="tab">Registrar</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<!-- Tab panes -->
		<div class="tab-content">

			<div role="tabpanel" class="tab-pane fade in" id="login">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="login-register-bg">

								<div class="row">

									<div class="{{-- col-md-7 col-sm-7 --}} col-xs-12">
										<div class="heading">
											<h2>Iniciar como <span>Trabajador</span></h2>
										</div>

										<form action="{{ route('worker.login') }}" method="POST">
											@csrf
											<div class="form-group">
												<input type="text" class="form-control" name="email" placeholder="Email">
												@error('email')
													<span class="invalid-feedback text-danger" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Contraseña">
												@error('password')
													<span class="invalid-feedback text-danger" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>

											<div class="form-group">
												<button type="submit">Entrar Ahora</button>
											</div>
											<div class="form-group">
												<a href="{{ route('login') }}">¿Eres cliente?</a>
											</div>
											<div class="form-group">
												<a href="#">¿Olvidaste tu contraseña?</a>
											</div>
										</form>
									</div>

									{{-- <div class="col-md-5 col-sm-5 col-xs-12">
										<div class="social-register-bg">

											<h3>Entrar con Redes Sociales</h3>

											<ul class="social-register-icon">
												<li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
												</li>
												<li><a href="#"><i class="fa fa-google"></i> Google+</a>
												</li>
												<li><a href="#"><i class="fa fa-twitter"></i> Twitter</a>
												</li>
											</ul>

										</div>
									</div> --}}

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>{{-- Fin del Tab Login --}}
			
			
			
			
			
			{{-- *********************************************************************************** --}}
			
			
			
			
			
			
			<div role="tabpanel" class="tab-pane fade in active" id="registerd">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="login-register-bg">

								<div class="row">

									<div class="{{-- col-md-7 col-sm-7 --}} col-xs-12">
										<div class="heading">
											<h2>Registro de <span>Trabajador</span></h2>
										</div>

										<form action="{{ route('worker.register') }}" method="POST">
											@csrf
											<div class="form-group">
												<input type="email" class="form-control" name="email" placeholder="Email" autofocus>
												@error('email')
													<span class="invalid-feedback text-danger" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											
											
											
											
											<div class="form-group">
												<input type="text" class="form-control" name="rut" placeholder="Rut: ejm. 00000000-X"
													   onchange="trimDots(this)">
												@error('rut')
													<span class="invalid-feedback text-danger" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											
											
											
											
											<div class="form-group">
												<input type="phone" class="form-control" name="phone_number" placeholder="Móvil">
												@error('phone_number')
													<span class="invalid-feedback text-danger" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Contraseña">
												@error('password')
													<span class="invalid-feedback text-danger" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña">
											</div>
											<div class="form-group">
												<button type="submit">Registrar Ahora!</button>
											</div>
											<div class="form-group">
												<a href="{{ route('register') }}">Registrarse como cliente</a>
											</div>
											<div class="form-group">
												<a href="{{ route('worker.login') }}">¿Ya eres trabajador? Iniciar sesión</a>
											</div>
										</form>
									</div>

									{{-- <div class="col-md-5 col-sm-5 col-xs-12">
										<div class="social-register-bg">

											<h3>Registro con Redes Sociales</h3>

											<ul class="social-register-icon">
												<li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
												</li>
												<li><a href="#"><i class="fa fa-google"></i> Google+</a>
												</li>
												<li><a href="#"><i class="fa fa-twitter"></i> Twitter</a>
												</li>
											</ul>

										</div>
									</div> --}}

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			{{-- ***************************************************************************************** --}}
			
			
			
			

		</div>

	</section>
	<!-- Popular Listing -->
@endsection

@section('scripts')
	<script>
		function trimDots (input) {
			input.value = input.value.replace('.', '');
			input.value = input.value.replace('.', '');
		}
	</script>
@endsection