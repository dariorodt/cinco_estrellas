@extends('layouts.site')

@section('title', 'Crear servicio')

@section('css')
@endsection

@section('content')
	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Mi Perfil</h2>
						<p><a href="#">Home</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Perfil</p>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Profile -->
	<section id="profile" class="p_b70 p_t70 bg_lightgry">

		<div class="container">
			<div class="row">

				<div class="col-md-3 col-sm-3 col-xs-12">

					<div class="profile-leftbar">
						<div id="profile-picture" class="profile-picture">
							@if ($worker->profile)
								<img src="{{ asset($worker->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					@component('partials.worker-panel-menu')
					@endcomponent
					
				</div>

				<div class="col-md-9 col-sm-9 col-xs-12">
					
					@foreach ($errors->all() as $message)
						<div class="alert alert-warning">
							{{ $message }}
						</div>
					@endforeach
					
					@if (session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('success') }}
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('warning') }}
						</div>
					@endif
					
					<div class="profile-login-bg">
						<h2>
							<span><i class="fa fa-sliders"></i></span> Generar nuevo <span>Servicios</span>
						</h2>
						
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="listing-title-area">
									
									<div class="col-md-12">
										<label>Generar Servicio <span>*</span></label>
									</div>
									
									
									
									
									
									
									
									
									
									
									
									
									<form id="new-service" action="{{ route('worker.service.add') }}" method="POST">
										@csrf
										
										<div class="col-md-12 form-group">
											<div class="single-query form-group ">
												<div class="intro">
													<label for="name">NOMBRE SERVICIO</label>
													<input type="text" name="name" class="form-control" required>
												</div>
											</div>
										</div>
										
										<div class="col-md-12 form-group">
											<div class="single-query form-group ">
												<div class="intro">
													<label for="description">DESCRIPCIÓN</label>
													<input type="text" name="description" class="form-control" required>
												</div>
											</div>
										</div>
										
										<div class="col-md-12 form-group">
											<h4>Nota Importante</h4>
											<p>
												Los servicios generados quedan por defecto en estado «Inactivo» hasta que sea revisado y aprobado por un administrador. Una vez que el servicio esté aprobado se le notificará.
											</p>
										</div>
										
										<div class="add-day">
											<div class="col-md-12">
												<div class="single-query form-group float_right">
													<a href="#" class="float_right" onclick="document.getElementById('new-service').submit()">
														<i class="fa fa-plus-square"></i> Añadir Servicio
													</a>
												</div>
											</div>
										</div>
									</form>
									
									
									
									
									
									
									
									
									
									
									
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Popular Listing -->
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('services_menu').classList.add('active');
			document.getElementById('worker-menu').classList.add('active');
		})();
	</script>
@endsection
