@extends('layouts.site')

@section('title', 'Mis Servicios')

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
						<h2><span><i class="fa fa-sliders"></i></span> Mis <span>Servicios</span></h2>
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="listing-title-area">
									
									
									
									<div class="col-md-12">
										<label>Servicios Agregados <span>*</span></label>
									</div>
									<div class="col-md-12 m_b30 borde_inferior">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Servicio</th>
													<th>Visita previa</th>
													<th>Costo Duirno</th>
													<th>Costo Nocturno</th>
													<th width="40">Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($services as $this_service)
													<tr>
														<td>{{ $this_service->name }}</td>
														<td>{{ $this_service->visit_required? 'Si' : 'No' }}</td>
														<td>{{ $this_service->pivot->day_cost }}</td>
														<td>{{ $this_service->pivot->night_cost }}</td>
														<td>
															<form action="{{ route('worker.service.delete', $this_service->id) }}" method="POST"
																	style="display: inline;">
																@csrf
																@method('DELETE')
																<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
															</form>
															<a href="{{ route('worker.service.edit', $this_service->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
									
									<div class="col-md-9 col-sm-9 col-xs-12"></div>
									
									<div class="col-md-3 col-sm-3 col-xs-12">
										<div class="form-group">
											<button class="float-right">
												<a href="{{ route('worker.service.create') }}"><i class="fa fa-plus-square"></i> Añadir</a>
											</button>
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
			document.getElementById('worker-menu').classList.add('active');
		})();
		
	</script>

@endsection
