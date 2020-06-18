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
								<img src="{{ asset($user->profile->image_path) }}" alt=""  width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt=""  width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					
					@component('partials.client-panel-menu')
					@endcomponent

				</div>

				<div class="col-md-9 col-sm-9 col-xs-12">
					
					@if (session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('success') }}
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4><i class="fa fa-warning"></i> ¡Advertencia!</h4>
							{{ session('warning') }}
						</div>
					@endif
					
					<div class="details-heading heading">
						<h2 class="p_b20">
							Editar sevicio de 
							<span>{{ $order->service->name }}</span>
							<small>
								<span class="badge badge-{{ $order->status }}">
									{{ $order->status == 'open' ? 'Abierta' : '' }}
									{{ $order->status == 'active' ? 'Activa' : '' }}
									{{ $order->status == 'closed' ? 'Cerrada' : '' }}
									{{ $order->status == 'canceled' ? 'Cancelada' : '' }}
								</span>
							</small>
						</h2>
						<form action="{{ route('user.order.update', $order->id) }}" method="POST">
							@csrf
							@method('PUT')
							
							<div class="row m_t20">
								<div class="col-md-12"><h3>Dirección</h3></div>
							</div>
								
							<div class="row m_t20">
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="email">Región</label>
										<input list="regions" class="form-control" id="email" name="region" type="text" value="{{ $order->region }}" required>
										@component('partials.region-datalist')
										@endcomponent
									</div>
									<!--/.form-group-->
								</div>
								
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="community">Comuna</label>
										<input list="communities" class="form-control" id="community" name="community" type="text" value="{{ $order->comunity }}" required>
										@component('partials.community-datalist')
										@endcomponent
									</div>
									<!--/.form-group-->
								</div>
								
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="city">Ciudad</label>
										<input list="cities" class="form-control" id="city" name="city" type="text" value="{{ $order->city }}" required>
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
										
							{{-- ¡IMPORTANTE!
								
								Las fechas de inicio y finalización actuales de definen en el 
								script de configuración del DataRangePicker que se encuentra 
								en la sección «scripts» al final de este archivo.
								
							--}}
										
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
										<select class="form-control" name="starting_time" required>
											<option {{ $order->starting_time == '00:00:00' ? 'selected' : '' }} value="00:00">00:00</option>
											<option {{ $order->starting_time == '00:30:00' ? 'selected' : '' }} value="00:30">00:30</option>
											<option {{ $order->starting_time == '01:00:00' ? 'selected' : '' }} value="01:00">01:00</option>
											<option {{ $order->starting_time == '01:30:00' ? 'selected' : '' }} value="01:30">01:30</option>
											<option {{ $order->starting_time == '02:00:00' ? 'selected' : '' }} value="02:00">02:00</option>
											<option {{ $order->starting_time == '02:30:00' ? 'selected' : '' }} value="02:30">02:30</option>
											<option {{ $order->starting_time == '03:00:00' ? 'selected' : '' }} value="03:00">03:00</option>
											<option {{ $order->starting_time == '03:30:00' ? 'selected' : '' }} value="03:30">03:30</option>
											<option {{ $order->starting_time == '04:00:00' ? 'selected' : '' }} value="04:00">04:00</option>
											<option {{ $order->starting_time == '04:30:00' ? 'selected' : '' }} value="04:30">04:30</option>
											<option {{ $order->starting_time == '05:00:00' ? 'selected' : '' }} value="05:00">05:00</option>
											<option {{ $order->starting_time == '05:30:00' ? 'selected' : '' }} value="05:30">05:30</option>
											<option {{ $order->starting_time == '06:00:00' ? 'selected' : '' }} value="06:00">06:00</option>
											<option {{ $order->starting_time == '06:30:00' ? 'selected' : '' }} value="06:30">06:30</option>
											<option {{ $order->starting_time == '07:00:00' ? 'selected' : '' }} value="07:00">07:00</option>
											<option {{ $order->starting_time == '07:30:00' ? 'selected' : '' }} value="07:30">07:30</option>
											<option {{ $order->starting_time == '08:00:00' ? 'selected' : '' }} value="08:00">08:00</option>
											<option {{ $order->starting_time == '08:30:00' ? 'selected' : '' }} value="08:30">08:30</option>
											<option {{ $order->starting_time == '09:00:00' ? 'selected' : '' }} value="09:00">09:00</option>
											<option {{ $order->starting_time == '09:30:00' ? 'selected' : '' }} value="09:30">09:30</option>
											<option {{ $order->starting_time == '10:00:00' ? 'selected' : '' }} value="10:00">10:00</option>
											<option {{ $order->starting_time == '10:30:00' ? 'selected' : '' }} value="10:30">10:30</option>
											<option {{ $order->starting_time == '11:00:00' ? 'selected' : '' }} value="11:00">11:00</option>
											<option {{ $order->starting_time == '11:30:00' ? 'selected' : '' }} value="11:30">11:30</option>
											<option {{ $order->starting_time == '12:00:00' ? 'selected' : '' }} value="12:00">12:00</option>
											<option {{ $order->starting_time == '12:30:00' ? 'selected' : '' }} value="12:30">12:30</option>
											<option {{ $order->starting_time == '13:00:00' ? 'selected' : '' }} value="13:00">13:00</option>
											<option {{ $order->starting_time == '13:30:00' ? 'selected' : '' }} value="13:30">13:30</option>
											<option {{ $order->starting_time == '14:00:00' ? 'selected' : '' }} value="14:00">14:00</option>
											<option {{ $order->starting_time == '14:30:00' ? 'selected' : '' }} value="14:30">14:30</option>
											<option {{ $order->starting_time == '15:00:00' ? 'selected' : '' }} value="15:00">15:00</option>
											<option {{ $order->starting_time == '15:30:00' ? 'selected' : '' }} value="15:30">15:30</option>
											<option {{ $order->starting_time == '16:00:00' ? 'selected' : '' }} value="16:00">16:00</option>
											<option {{ $order->starting_time == '16:30:00' ? 'selected' : '' }} value="16:30">16:30</option>
											<option {{ $order->starting_time == '17:00:00' ? 'selected' : '' }} value="17:00">17:00</option>
											<option {{ $order->starting_time == '17:30:00' ? 'selected' : '' }} value="17:30">17:30</option>
											<option {{ $order->starting_time == '18:00:00' ? 'selected' : '' }} value="18:00">18:00</option>
											<option {{ $order->starting_time == '18:30:00' ? 'selected' : '' }} value="18:30">18:30</option>
											<option {{ $order->starting_time == '19:00:00' ? 'selected' : '' }} value="19:00">19:00</option>
											<option {{ $order->starting_time == '19:30:00' ? 'selected' : '' }} value="19:30">19:30</option>
											<option {{ $order->starting_time == '20:00:00' ? 'selected' : '' }} value="20:00">20:00</option>
											<option {{ $order->starting_time == '20:30:00' ? 'selected' : '' }} value="20:30">20:30</option>
											<option {{ $order->starting_time == '21:00:00' ? 'selected' : '' }} value="21:00">21:00</option>
											<option {{ $order->starting_time == '21:30:00' ? 'selected' : '' }} value="21:30">21:30</option>
											<option {{ $order->starting_time == '22:00:00' ? 'selected' : '' }} value="22:00">22:00</option>
											<option {{ $order->starting_time == '22:30:00' ? 'selected' : '' }} value="22:30">22:30</option>
											<option {{ $order->starting_time == '23:00:00' ? 'selected' : '' }} value="23:00">23:00</option>
											<option {{ $order->starting_time == '23:30:00' ? 'selected' : '' }} value="23:30">23:30</option>
											<option {{ $order->starting_time == '24:00:00' ? 'selected' : '' }} value="24:00">24:00</option>
											<option {{ $order->starting_time == '24:30:00' ? 'selected' : '' }} value="24:30">24:30</option>
										</select>
									</dov>
								</div>
								
								<div class="col-md-3">
									<dov class="form-group">
										<label>Hora de finalización</label>
										<select class="form-control" name="ending_time" required>
											<option {{ $order->ending_time == '00:00:00' ? 'selected' : '' }} value="00:00">00:00</option>
											<option {{ $order->ending_time == '00:30:00' ? 'selected' : '' }} value="00:30">00:30</option>
											<option {{ $order->ending_time == '01:00:00' ? 'selected' : '' }} value="01:00">01:00</option>
											<option {{ $order->ending_time == '01:30:00' ? 'selected' : '' }} value="01:30">01:30</option>
											<option {{ $order->ending_time == '02:00:00' ? 'selected' : '' }} value="02:00">02:00</option>
											<option {{ $order->ending_time == '02:30:00' ? 'selected' : '' }} value="02:30">02:30</option>
											<option {{ $order->ending_time == '03:00:00' ? 'selected' : '' }} value="03:00">03:00</option>
											<option {{ $order->ending_time == '03:30:00' ? 'selected' : '' }} value="03:30">03:30</option>
											<option {{ $order->ending_time == '04:00:00' ? 'selected' : '' }} value="04:00">04:00</option>
											<option {{ $order->ending_time == '04:30:00' ? 'selected' : '' }} value="04:30">04:30</option>
											<option {{ $order->ending_time == '05:00:00' ? 'selected' : '' }} value="05:00">05:00</option>
											<option {{ $order->ending_time == '05:30:00' ? 'selected' : '' }} value="05:30">05:30</option>
											<option {{ $order->ending_time == '06:00:00' ? 'selected' : '' }} value="06:00">06:00</option>
											<option {{ $order->ending_time == '06:30:00' ? 'selected' : '' }} value="06:30">06:30</option>
											<option {{ $order->ending_time == '07:00:00' ? 'selected' : '' }} value="07:00">07:00</option>
											<option {{ $order->ending_time == '07:30:00' ? 'selected' : '' }} value="07:30">07:30</option>
											<option {{ $order->ending_time == '08:00:00' ? 'selected' : '' }} value="08:00">08:00</option>
											<option {{ $order->ending_time == '08:30:00' ? 'selected' : '' }} value="08:30">08:30</option>
											<option {{ $order->ending_time == '09:00:00' ? 'selected' : '' }} value="09:00">09:00</option>
											<option {{ $order->ending_time == '09:30:00' ? 'selected' : '' }} value="09:30">09:30</option>
											<option {{ $order->ending_time == '10:00:00' ? 'selected' : '' }} value="10:00">10:00</option>
											<option {{ $order->ending_time == '10:30:00' ? 'selected' : '' }} value="10:30">10:30</option>
											<option {{ $order->ending_time == '11:00:00' ? 'selected' : '' }} value="11:00">11:00</option>
											<option {{ $order->ending_time == '11:30:00' ? 'selected' : '' }} value="11:30">11:30</option>
											<option {{ $order->ending_time == '12:00:00' ? 'selected' : '' }} value="12:00">12:00</option>
											<option {{ $order->ending_time == '12:30:00' ? 'selected' : '' }} value="12:30">12:30</option>
											<option {{ $order->ending_time == '13:00:00' ? 'selected' : '' }} value="13:00">13:00</option>
											<option {{ $order->ending_time == '13:30:00' ? 'selected' : '' }} value="13:30">13:30</option>
											<option {{ $order->ending_time == '14:00:00' ? 'selected' : '' }} value="14:00">14:00</option>
											<option {{ $order->ending_time == '14:30:00' ? 'selected' : '' }} value="14:30">14:30</option>
											<option {{ $order->ending_time == '15:00:00' ? 'selected' : '' }} value="15:00">15:00</option>
											<option {{ $order->ending_time == '15:30:00' ? 'selected' : '' }} value="15:30">15:30</option>
											<option {{ $order->ending_time == '16:00:00' ? 'selected' : '' }} value="16:00">16:00</option>
											<option {{ $order->ending_time == '16:30:00' ? 'selected' : '' }} value="16:30">16:30</option>
											<option {{ $order->ending_time == '17:00:00' ? 'selected' : '' }} value="17:00">17:00</option>
											<option {{ $order->ending_time == '17:30:00' ? 'selected' : '' }} value="17:30">17:30</option>
											<option {{ $order->ending_time == '18:00:00' ? 'selected' : '' }} value="18:00">18:00</option>
											<option {{ $order->ending_time == '18:30:00' ? 'selected' : '' }} value="18:30">18:30</option>
											<option {{ $order->ending_time == '19:00:00' ? 'selected' : '' }} value="19:00">19:00</option>
											<option {{ $order->ending_time == '19:30:00' ? 'selected' : '' }} value="19:30">19:30</option>
											<option {{ $order->ending_time == '20:00:00' ? 'selected' : '' }} value="20:00">20:00</option>
											<option {{ $order->ending_time == '20:30:00' ? 'selected' : '' }} value="20:30">20:30</option>
											<option {{ $order->ending_time == '21:00:00' ? 'selected' : '' }} value="21:00">21:00</option>
											<option {{ $order->ending_time == '21:30:00' ? 'selected' : '' }} value="21:30">21:30</option>
											<option {{ $order->ending_time == '22:00:00' ? 'selected' : '' }} value="22:00">22:00</option>
											<option {{ $order->ending_time == '22:30:00' ? 'selected' : '' }} value="22:30">22:30</option>
											<option {{ $order->ending_time == '23:00:00' ? 'selected' : '' }} value="23:00">23:00</option>
											<option {{ $order->ending_time == '23:30:00' ? 'selected' : '' }} value="23:30">23:30</option>
											<option {{ $order->ending_time == '24:00:00' ? 'selected' : '' }} value="24:00">24:00</option>
											<option {{ $order->ending_time == '24:30:00' ? 'selected' : '' }} value="24:30">24:30</option>
										</select>
									</dov>
								</div>
							</div>
							
							<div class="row m_t20">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="description">Información adicional</label>
										<textarea class="form-control" name="aditional_info" required>{{ $order->aditional_info }}</textarea>
									</div>
								</div>
							</div>

							<div class="row m_t30">
								<div class="col-md-12">
									<h3>Aplicaciones</h3>
								</div>
							</div>

							<div class="row m_t20">
								<div class="col-md-12">
									<div class="applications">
										@if ($order->status == 'open')
											@foreach ($order->applications as $application)
												<div class="col-sm-6 col-xs-12">
													<div class="popular-listing-box">
														<div class="popular-listing-img">
															<figure class="effect-ming"> 
																<img src="{{ asset($application->worker->profile->image_path) }}" alt="image" style="
																	width: 100%;
																	height: 190px;
																	object-fit: cover;
																	">
																{{-- <figcaption>
																	<ul>
																		<li>
																			<a href="{{ route('user.order.hire', [$order, $application->worker]) }}" title="Contratar"><i class="fa fa-check" aria-hidden="true"></i></a>
																		</li>
																		<li><a href="#!"><i class="fa fa-paper-plane" aria-hidden="true"></i></a> </li>
																		<li><a href="#!"><i class="fa fa-unlock" aria-hidden="true"></i></a> </li>
																	</ul>
																</figcaption> --}}
															</figure>
														</div>
														<div class="popular-listing-detail">
															<h3><a href="">{{ $application->worker->profile->full_name() }}</a></h3>
															@php
																$service_worker = $application->worker->services->find($order->service_id);
															@endphp
															<p>
																<b>Costo diurno:</b> {{ $service_worker->pivot->day_cost }} <br>
																<b>Costo nocturno:</b> {{ $service_worker->pivot->night_cost }} <br>
																<b>{{ $service_worker->pivot->visit_required? 'Visita requerida' : 'No requiere visita' }}</b>
															</p>
															<a class="btn btn-primary btn-xs b_m20" href="{{ route('user.order.hire', [$order, $application->worker]) }}" title="Contratar">Contratar</a><p></p>
														</div>
														<div class="popular-listing-add">
															<span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $application->job->city }}</span>
															<span class="rateit pull-right" data-rateit-value="{{ $application->worker->ratings->avg('stars') }}" data-rateit-readonly="true"></span>
														</div>
													</div>
												</div>
											@endforeach
										@elseif($order->status == 'active')
											<div class="col-sm-6 col-xs-12">
												<div class="popular-listing-box">
													<div class="popular-listing-img">
														<figure class="effect-ming"> 
															<img src="{{ asset($order->worker->profile->image_path) }}" alt="image" style="
																width: 100%;
																height: 190px;
																object-fit: cover;
																">
															<figcaption>
																<ul>
																	<li><a href="{{ route('user.message.chat', $order) }}"><i class="fa fa-paper-plane" aria-hidden="true"></i></a> </li>
																	<li><a href="#!"><i class="fa fa-unlock" aria-hidden="true"></i></a> </li>
																</ul>
															</figcaption>
														</figure>
													</div>
													<div class="popular-listing-detail">
														<h3><a href="listing-details.html">Servicio de {{ $order->service->name }}</a></h3>
														<p>{{ $order->aditional_info }}</p>
													</div>
													<div class="popular-listing-add">
														<span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $order->worker->profile->city }}</span> 
														<span class="rateit pull-right" data-rateit-value="{{ $order->worker->ratings->avg('stars') }}" data-rateit-readonly="true"></span>
													</div>
												</div>
											</div>
										@elseif($order->status == 'closed')
											<div class="col-sm-6 col-xs-12">
												<div class="popular-listing-box">
													<div class="popular-listing-img">
														<figure class="effect-ming"> 
															<img src="{{ asset($order->worker->profile->image_path) }}" alt="image" style="
																width: 100%;
																height: 190px;
																object-fit: cover;
																">
														</figure>
													</div>
													<div class="popular-listing-detail">
														<h3><a href="listing-details.html">Servicio de {{ $order->service->name }}</a></h3>
														<p>{{ $order->aditional_info }}</p>
													</div>
													<div class="popular-listing-add">
														<span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $order->worker->profile->city }}</span> 
														@if ($order->worker_rating)
															<span class="rateit pull-right" data-rateit-value="{{ $order->worker->ratings->avg('stars') }}" data-rateit-readonly="true"></span>
														@else 
															<a href="{{ route('user.rating.create', $order) }}" class="btn btn-primary pull-right">Calificar</a>
														@endif
													</div>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							
							<div class="row m_t30">
								<div class="col-xs-6 col-sm-4 col-md-3">
									<div class="form-group">
										<button class="btn btn-primary" formaction="{{ route('user.order.close', $order) }}"><i class="fa fa-circle-o-notch"></i> Cerrar</button>
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-3">
									<div class="form-group">
										<button class="btn btn-primary" formaction="{{ route('user.order.cancel', $order) }}"><i class="fa fa-times"></i> Cancelar</button>
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-3">
									<div class="form-group">
										<button class="btn btn-primary"><a href="/home/orders"><i class="fa fa-arrow-left"></i> Regresar</a></button>
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-3 pull-right">
									<div class="form-group">
										<button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Actualizar</button>
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
		
		/*
			NOTA IMPORTANTE:
			Esta función controla el comportamiento y la configuración de 
			DataRangePicker.
			El PlugIn está basado en jQuery y MomentJS, por lo que las fechas 
			son manipuladas por éste último.
		*/
		$(function() {
			$('input[name="daterange"]').daterangepicker({
				locale: {
					format: "DD/MM/YYYY",
					firstDay: 0
				},
				startDate: moment('{{ $order->starting_date }}'),
    		endDate: moment('{{ $order->ending_date }}'),
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

