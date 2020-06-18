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
							@if ($worker->profile)
								<img src="{{ asset($worker->profile->image_path) }}" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					@component('partials.worker-panel-menu')
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
									 <div class="col-md-6 col-sm-6">
										<div class="info-box-main">
											<div class="info-stats">
												<p>{{ $worker->payments->sum('amount') }}</p>
												<span>Total de Ingresos </span>
											</div>
											
											<div class="info-icon text-primary ">
												<i class="fa fa-dollar"></i>
											</div>

											<div class="info-box-progress">
												<div class="progress">
													<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6">
										<div class="info-box-main">
											<div class="info-stats">
												<p>{{ $worker->service_orders->where('status', 'closed')->count() }}</p>
												<span>Trabajos Realizados</span>
											</div>
											<div class="info-icon text-info">
												<i class="mdi mdi-account-multiple"></i>   
											</div>
											<div class="info-box-progress">
												<div class="progress">
													<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-4 col-sm-6">
										<div class="info-box-main">
											<div class="info-stats">
												<p>{{ $worker->payments->filter(function($payment) {
													return $payment->created_at->month == \Carbon\Carbon::now()->month;
												})->avg('amount') }}</p>
												<span>Ingresos este MES</span>
											</div>
											<div class="info-icon text-warning">
												<i class="fa fa-dollar"></i>
											</div>
											<div class="info-box-progress">
												<div class="progress">
													<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-12">
										<div class="white-box">
												<h4 class="header-title"> Pagos </h4>
												<div class="table-responsive">
													<table class="table table-hover">
														<thead>
															<tr>
																<th>#</th>
																<th>Servicio</th>
																<th>Cliente</th>
																<th>Fecha Servicio</th>
																<th>Fecha Pago</th>
																<th>Monto</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($worker->payments as $payment)
																<tr>
																	<td>{{ $payment->id }}</td>
																	<td>{{ $payment->order->service->name }}</td>
																	<td>{{ $payment->order->client->profile->full_name() }}</td>
																	<td>{{ \Carbon\Carbon::create($payment->order->starting_date)->isoFormat('L') }} al {{ \Carbon\Carbon::create($payment->order->ending_date)->isoFormat('L') }}</td>
																	<td>{{ $payment->created_at->isoFormat('LLL') }}</td>
																	<td>{{ number_format($payment->amount, 0, ",", ".") }}</td>
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
			document.getElementById('worker-menu').classList.add('active');
		})()
	</script>

@endsection

