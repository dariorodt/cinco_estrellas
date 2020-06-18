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
				<section id="blog" class="p_b70 p_t70 bg_lightgry">
					<div class="container">
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="row">
									<div class="col-md-12 heading">
										<h2>Mis Pagos</h2>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="white-box">
												<h4 class="header-title"> Pagos </h4>
												<div class="table-responsive">
													<table class="table table-hover">
														<thead>
															<tr>
																<th>Servicio</th>
																<th>Trabajador</th>
																
																
																<th>Fecha Servicio</th>
																<th>Fecha Pago</th>
																<th>Tarjeta</th>
																<th>Monto</th>
															</tr>
														</thead>
														<tbody>
															@foreach (Auth::user()->payments as $payment)
																<tr>
																	<td><a href="{{ route('user.payment.detail', $payment) }}" title="Ver detalle">{{ $payment->order->service->name }}</a></td>
																	<td><a href="{{ route('user.payment.detail', $payment) }}" title="Ver detalle">{{ $payment->worker->profile->full_name() }}</a></td>
																	
																	
																	
																	
																	<td>{{ Carbon\Carbon::create(date($payment->order->created_at))->isoFormat('L') }}</td>
																	<td>{{ Carbon\Carbon::create(date($payment->created_at))->isoFormat('L') }}</td>
																	<td>XXXX-XXXX-{{ $payment->card_number }}</td>
																	<td>${{ number_format($payment->amount, 0, ",", ".") }}</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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

