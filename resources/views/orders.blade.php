@extends('layouts.site')

@section('title', 'Mis Solicitudes')

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
					
					@if ($user->profile->status == 'inactive')
						<div class="alert alert-danger text-center" role="alert">
							<h3>Usted se encuentra actualmente inactivo</h3>
							Por lo tanto no puede solicitar servicios. <br>
							Contacte a soporte para más información...
						</div>
					@endif
					
					<div class="profile-login-bg">
						<h2><span><i class="fa fa-sliders"></i></span> Mis solicitudes de <span>Servicio</span></h2>
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="listing-title-area">
									
									
									
									<div class="col-md-12">
										<label>Servicios solicitados <span>*</span></label>
									</div>
									<div class="col-md-12 m_b30 borde_inferior">
										@foreach ($orders as $this_order)
										
											<form action="{{ route('user.order.delete', $this_order) }}" method="POST">
												@csrf
												@method('DELETE')
											
												<div class="service-order">
													<div class="header text-center">
														<span class="title pull-left">
															{{ $this_order->service->name }} 
															<span class="badge badge-{{ $this_order->status }}">
																{{ $this_order->status == 'open' ? 'Abierta' : '' }}
																{{ $this_order->status == 'active' ? 'Activa' : '' }}
																{{ $this_order->status == 'closed' ? 'Cerrada' : '' }}
																{{ $this_order->status == 'canceled' ? 'Cancelada' : '' }}
															</span>
														</span>
														<span class="date">{{ $this_order->created_at->isoFormat('LLL') }}</span>
														<span class="pull-right">
															<button type="submit" class="btn btn-link"><i class="fa fa-times" title="Eliminar"></i></button>
															<a href="{{ route('user.order.edit', $this_order->id) }}" class="btn btn-link"><i class="fa fa-edit" title="Editar"></i></a>
														</span>
													</div>
													<div class="body">
														<div class="date">
															<b>Desde:</b> {{ date_format(new DateTime($this_order->starting_date), 'd/m/Y') }}<br>
															<b>Hasta:</b> {{ date_format(new DateTime($this_order->ending_date), 'd/m/Y') }}
														</div>
														<div class="time">
															<b>Horario:</b> <br>
															De {{ $this_order->starting_time }} a {{ $this_order->ending_time }}
														</div>
														<div class="applications">
															@if ($this_order->status == 'open' || $this_order->status == 'canceled')
																@if ($this_order->applications->count())
																	@foreach ($this_order->applications as $application)
																		<img class="worker-img" src="{{ asset($application->worker->profile->image_path) }}" title="{{ $application->worker->profile->full_name() }}">
																	@endforeach
																@else
																	No tiene aplicaciones en este momento
																@endif
															@elseif($this_order->status == 'active' || $this_order->status == 'closed')
																<img src="{{ asset($this_order->worker->profile->image_path) }}">
															@endif
														</div>
													</div>
												</div>
											</form>
										@endforeach
										
									</div>
									
									<div class="col-md-9 col-sm-9 col-xs-12"></div>
									
									<div class="col-md-3 col-sm-3 col-xs-12">
										<div class="form-group">
											@if ($user->profile->status == 'active')
												<button class="float-right">
													<a href="{{ route('user.order.create') }}"><i class="fa fa-plus-square"></i> Añadir</a>
												</button>
											@endif
										</div>
									</div>
									
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
		})()
	</script>

@endsection

