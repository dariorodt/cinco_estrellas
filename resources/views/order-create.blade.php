@extends('layouts.site')

@section('title', 'Mis Solicitudes')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}">
@endsection

@section('content')

	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Mi Perfil</h2>
						<p><a href="index.html">Home</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Perfil</p>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Profile -->
	<section id="listing-details" class="p_b70 p_t70 bg_lightgry">

		<div class="container">
			<div class="row">

				<div class="col-md-3 col-sm-3 col-xs-12">

					<div class="profile-leftbar">
						<div id="profile-picture" class="profile-picture">
							@if ($user->profile)
								<img src="{{ asset($user->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					@component('partials.client-panel-menu')
					@endcomponent
				</div>

				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="details-heading heading">
						<h2 class="p_b20">Solicitar nuevo <span>Servicio</span></h2>
						<form action="{{ route('user.order.store') }}" method="POST">
							@csrf
							
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<label for="service">Servicio a solicitar</label>
										<select class="form-control" name="service" required>
											<option selected disabled>Seleccione Servicio</option>
											@foreach ($services as $serv)
												<option value="{{ $serv->id }}">{{ $serv->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							
							<div class="row m_t20">
								<div class="col-md-12"><h3>Dirección</h3></div>
							</div>
								
							<div class="row m_t20">
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="email">Región</label>
										<input list="regions" class="form-control" id="email" name="region" type="text" required>
										@component('partials.region-datalist')
										@endcomponent
									</div>
									<!--/.form-group-->
								</div>
								
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="community">Comuna</label>
										<input list="communities" class="form-control" id="community" name="community" type="text" required>
										@component('partials.community-datalist')
										@endcomponent
									</div>
									<!--/.form-group-->
								</div>
								
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="city">Ciudad</label>
										<input list="cities" class="form-control" id="city" name="city" type="text" required>
										@component('partials.city-datalist')
										@endcomponent
									</div>
									<!--/.form-group-->
								</div>
							</div>
							
							<div class="row m_t20">
								<div class="col-md-12">
									<h3>Indique fecha de contratación</h3>
								</div>
							</div>
								
							<div class="row m_t20">
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('daterange') ? 'has-error' : '' }}">
										<label for="finish-date">Fechas</label>
										<input id="daterange" class="form-control" type="text" name="daterange" required>
										{!! $errors->first('daterange', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								
								<div class="col-md-3">
									<dov class="form-group">
										<label>Hora de inicio</label>
										<select class="form-control" name="start-time" required>
											<option value="00:00">00:00</option>
											<option value="00:30">00:30</option>
											<option value="01:00">01:00</option>
											<option value="01:30">01:30</option>
											<option value="02:00">02:00</option>
											<option value="02:30">02:30</option>
											<option value="03:00">03:00</option>
											<option value="03:30">03:30</option>
											<option value="04:00">04:00</option>
											<option value="04:30">04:30</option>
											<option value="05:00">05:00</option>
											<option value="05:30">05:30</option>
											<option value="06:00">06:00</option>
											<option value="06:30">06:30</option>
											<option value="07:00">07:00</option>
											<option value="07:30">07:30</option>
											<option value="08:00">08:00</option>
											<option value="08:30">08:30</option>
											<option value="09:00">09:00</option>
											<option value="09:30">09:30</option>
											<option value="10:00">10:00</option>
											<option value="10:30">10:30</option>
											<option value="11:00">11:00</option>
											<option value="11:30">11:30</option>
											<option value="12:00">12:00</option>
											<option value="12:30">12:30</option>
											<option value="13:00">13:00</option>
											<option value="13:30">13:30</option>
											<option value="14:00">14:00</option>
											<option value="14:30">14:30</option>
											<option value="15:00">15:00</option>
											<option value="15:30">15:30</option>
											<option value="16:00">16:00</option>
											<option value="16:30">16:30</option>
											<option value="17:00">17:00</option>
											<option value="17:30">17:30</option>
											<option value="18:00">18:00</option>
											<option value="18:30">18:30</option>
											<option value="19:00">19:00</option>
											<option value="19:30">19:30</option>
											<option value="20:00">20:00</option>
											<option value="20:30">20:30</option>
											<option value="21:00">21:00</option>
											<option value="21:30">21:30</option>
											<option value="22:00">22:00</option>
											<option value="22:30">22:30</option>
											<option value="23:00">23:00</option>
											<option value="23:30">23:30</option>
											<option value="24:00">24:00</option>
											<option value="24:30">24:30</option>
										</select>
									</dov>
								</div>
								
								<div class="col-md-3">
									<dov class="form-group">
										<label>Hora de finalización</label>
										<select class="form-control" name="finish-time" required>
											<option value="00:00">00:00</option>
											<option value="00:30">00:30</option>
											<option value="01:00">01:00</option>
											<option value="01:30">01:30</option>
											<option value="02:00">02:00</option>
											<option value="02:30">02:30</option>
											<option value="03:00">03:00</option>
											<option value="03:30">03:30</option>
											<option value="04:00">04:00</option>
											<option value="04:30">04:30</option>
											<option value="05:00">05:00</option>
											<option value="05:30">05:30</option>
											<option value="06:00">06:00</option>
											<option value="06:30">06:30</option>
											<option value="07:00">07:00</option>
											<option value="07:30">07:30</option>
											<option value="08:00">08:00</option>
											<option value="08:30">08:30</option>
											<option value="09:00">09:00</option>
											<option value="09:30">09:30</option>
											<option value="10:00">10:00</option>
											<option value="10:30">10:30</option>
											<option value="11:00">11:00</option>
											<option value="11:30">11:30</option>
											<option value="12:00">12:00</option>
											<option value="12:30">12:30</option>
											<option value="13:00">13:00</option>
											<option value="13:30">13:30</option>
											<option value="14:00">14:00</option>
											<option value="14:30">14:30</option>
											<option value="15:00">15:00</option>
											<option value="15:30">15:30</option>
											<option value="16:00">16:00</option>
											<option value="16:30">16:30</option>
											<option value="17:00">17:00</option>
											<option value="17:30">17:30</option>
											<option value="18:00">18:00</option>
											<option value="18:30">18:30</option>
											<option value="19:00">19:00</option>
											<option value="19:30">19:30</option>
											<option value="20:00">20:00</option>
											<option value="20:30">20:30</option>
											<option value="21:00">21:00</option>
											<option value="21:30">21:30</option>
											<option value="22:00">22:00</option>
											<option value="22:30">22:30</option>
											<option value="23:00">23:00</option>
											<option value="23:30">23:30</option>
											<option value="24:00">24:00</option>
											<option value="24:30">24:30</option>
										</select>
									</dov>
								</div>
								
								<div class="col-md-12">
									<div class="alert alert-info">
										<p>Tome en cuenta que el trabajador necesita un margen de tiempo para responder su solicitud.</p>
										<p>Contrate con una anticipación de, al menos, 72 horas.</p>
									</div>
								</div>
							</div>
							
							<div class="row m_t20">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="description">Información adicional</label>
										<textarea class="form-control" name="aditional_info" required></textarea>
									</div>
								</div>
							</div>
							
							<div class="row m_t30">
								<div class="col-xs-6 col-sm-4 col-md-3 pull-right">
									<div class="form-group">
										<button class="btn btn-primary" type="submit">Enviar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
		</div>
	</div>




	</section>
	<!-- Popular Listing -->
@endsection

@section('scripts')
	
	<script src="{{ asset('js/moment/moment.js') }}"></script>
	<script src="{{ asset('js/daterangepicker.min.js') }}"></script>
	<script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker({
				locale: {
					format: "DD/MM/YYYY",
					firstDay: 0
				},
				startDate: moment().startOf('hour').add(2, 'days'),
    		endDate: moment().startOf('hour').add(3, 'days'),
			}, function(start, end, label) {
				console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
		});
	</script>
	
	<script>
		(function() {
			document.getElementById('services_menu').classList.add('active');
		})()
	</script>

@endsection

