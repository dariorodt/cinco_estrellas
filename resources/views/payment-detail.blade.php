@extends('layouts.site')

@section('title', 'Mis pagos')

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
						<p><a href="index.html">Home</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Perfil</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Profile -->
	<section id="profile" class="p_b70 p_t70 bg_lightgry">
		<div class="container">
			<div class="row"> {{-- Fila general --}}
				
				
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
				
				
				<section id="blog" class="p_b70 p_t70 bg_lightgry">
					<div class="container">
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-12">
								
								
								
								
								
								
								{{-- Title --}}
								<div class="row">
									<div class="col-md-12 heading">
										<h2>Pago Orden de servicio # {{ $payment->order->id }}, <span>{{ $payment->order->service->name }}</span></h2>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="white-box">
												<h4 class="header-title">Ticket # {{ $payment->id }}</h4>
												<div class="table-responsive">
													<table class="table table-hover">
														<tbody>
															<tr>
																<td>Monto:</td>
																<td>{{ number_format($payment->amount, 0, ",", ".") }} CLP</td>
															</tr>
															<tr>
																<td>Fecha servicio:</td>
																<td>{{ $payment->order->created_at }}</td>
															</tr>
															<tr>
																<td>Fecha de pago:</td>
																<td>{{ $payment->created_at }}</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="popular-listing-box">
												<div class="popular-listing-img">
													<figure class="effect-ming"> 
														<img src="{{ asset($payment->worker->profile->image_path) }}" alt="image" style="
															width: 100%;
															height: 190px;
															object-fit: cover;
															">
														<figcaption>
															<ul>
																<li><a href="#!"><i class="fa fa-paper-plane" aria-hidden="true"></i></a> </li>
																<li><a href="#!"><i class="fa fa-unlock" aria-hidden="true"></i></a> </li>
															</ul>
														</figcaption>
													</figure>
												</div>
												<div class="popular-listing-detail">
													<h3><a href="">{{ $payment->worker->profile->full_name() }}</a></h3>
													@php
														$service_worker = $payment->worker->services->find($payment->order->service_id);
													@endphp
													<p>
														<b>Costo diurno:</b> {{ $service_worker->pivot->day_cost }} <br>
														<b>Costo nocturno:</b> {{ $service_worker->pivot->night_cost }} <br>
														<b>{{ $service_worker->pivot->visit_required? 'Visita requerida' : 'No requiere visita' }}</b>
													</p>
												</div>
												<div class="popular-listing-add">
													<span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $payment->worker->profile->city }}</span>
													<span class="rateit pull-right" data-rateit-value="{{ $payment->worker->ratings->avg('stars') }}"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>{{-- /.row --}}
					</div>{{-- /.container --}}
				</section>
			</div>{{-- /.row --}}
		</div>{{-- /.container --}}
	</section>
@endsection

@section('scripts')

	<script>
		(function() {
			document.getElementById('payments_menu').classList.add('active');
		})()
	</script>

@endsection

