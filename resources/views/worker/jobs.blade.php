@extends('layouts.site')

@section('title', 'Mis trabajos')

@section('css')
@endsection

@section('content')

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
	
	<!-- Profile -->
	<section id="popular-listing bg" class="p_b70 p_t70 bg_lightgry">
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
					
					<!-- Tab panes -->
					<div class="tab-content">

						<div role="tabpanel" class="tab-pane fade in active" id="profile">
							<div class="row">
								@if (Auth::user()->profile->state == 'active')
									@foreach ($open_orders as $this_order)
										<div class="col-sm-6 col-xs-12">
											<div class="popular-listing-box">
												<div class="popular-listing-img">
													<figure class="effect-ming"> 
														<img src="{{ asset($this_order->client->profile->image_path) }}" alt="image" style="
															width: 100%;
															height: 190px;
															object-fit: cover;
															">
														<figcaption>
															<ul>
																@if ($this_order->applications->where('worker_id', $worker->id)->count())
																	<li><a href="#!"><i class="fa fa-paper-plane" aria-hidden="true"></i></a> </li>
																	<li><a href="#!"><i class="fa fa-unlock" aria-hidden="true"></i></a> </li>
																@else
																	<li><a href="{{ route('worker.job.apply', $this_order->id) }}" title="Aplicar"><i class="fa fa-check" aria-hidden="true"></i></a> </li>
																@endif
															</ul>
														</figcaption>
													</figure>
												</div>
												<div class="popular-listing-detail">
													<h3><a href="listing-details.html">Servicio de {{ $this_order->service->name }}</a></h3>
													<p>{{ $this_order->aditional_info }}</p>
												</div>
												<div class="popular-listing-add">
													<span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $this_order->city }}</span> 
													<span class="rateit pull-right" data-rateit-value="{{ $this_order->client->ratings->avg('stars') }}" data-rateit-ispreset="true" data-rateit-readonly="true"></span>	
												</div>
											</div>
										</div>
									@endforeach
								@else
									<div class="alert alert-warning alert-dismissible" role="alert">
										<h4><i class="fa fa-warning"></i> ¡Advertencia!</h4>
										Su estado actual es «INACTIVO», por lo tanto, usted no podrá ofrecer servicios no aplicar a solicitudes hasta que nuestro equipo de revisión apruebe su perfil. <br>
										Por favor, asegúrese de llenar cuidadosamente los datos requeridos para su perfil, subir los documentos necesarios y leer cuidadosamente los términos y condiciones (enlace al final de esta página).<br>
										El proceso de revisión suele tomar un máximo de 48 horas.
									</div>
								@endif
								
							</div>
						</div>

						
					</div>

					<div>
						{{ $open_orders->links() }}
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
			document.getElementById('works_menu').classList.add('active');
			document.getElementById('worker-menu').classList.add('active');
		})()
	</script>

@endsection

