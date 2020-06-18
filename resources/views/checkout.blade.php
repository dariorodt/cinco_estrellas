@extends('layouts.site')

@section('title', 'Formulario de pago')

@section('css')
@endsection

@section('content')
	{{-- Inner Banner --}}
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
	{{-- Inner Banner --}}
	
	{{-- Profile --}}
	<section id="listing-details" class="p_b70 p_t70 bg_lightgry">

		<div class="container">
			<div class="row">
				
				@php
					$user = Auth::user();
				@endphp

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
					
					@php
						$messages_count = 0;
						
						foreach (Auth::user()->service_orders as $this_order) {
							foreach ($this_order->messages as $message) {
								if(!$message->viewed && $message->sender == 'worker') $messages_count++;
							}
						}
					@endphp
					
					@component('partials.client-panel-menu')
					@endcomponent

				</div>
				
				<div class="col-md-9 col-sm-3 col-xs-12">
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
					
					<div class="details-heading heading">
						<h2 class="p_b30">Pago con WebPay</h2>
						<p>Está apunto de contratar a <strong>{{ $worker->profile->full_name() }}</strong> para un servicio de <strong>{{ $worker_service->name }}</strong></p>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Opción</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>Fecha de contratación:</strong></td>
									<td>De {{ \Carbon\Carbon::create($order->starting_date)->isoFormat('L') }} a {{ \Carbon\Carbon::create($order->ending_date)->isoFormat('L') }}</td>
								</tr>
								<tr>
									<td><strong>Horario:</strong></td>
									<td>Desde las {{ $order->starting_time }} hasta las {{ $order->ending_time }}</td>
								</tr>
								<tr>
									<td><strong>Días contratados</strong></td>
									<td>{{ $days }} días</td>
								</tr>
								<tr>
									<td><strong>Costo por día</strong></td>
									<td>{{ number_format($worker_service->pivot->day_cost, 0) }} pesos</td>
								</tr>
								<tr>
									<td><strong>Costo total a pagar:</strong></td>
									<td>{{ number_format($amount, 0) }} pesos</td>
								</tr>
							</tbody>
						</table>
						<div class="m_t30">
							<form action="{{ $form_action }}" method="POST" role="form">
								<input type="hidden" name="token_ws" value="{{ $token }}">
								<button type="submit" class="btn btn-primary">Pagar</button>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	{{-- Profile --}}
	
	
@endsection

@section('scripts')
@endsection

