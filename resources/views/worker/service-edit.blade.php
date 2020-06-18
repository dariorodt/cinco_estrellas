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
					
					<div class="profile-login-bg">
						<h2><span><i class="fa fa-sliders"></i></span> Mis <span>Servicios</span></h2>
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="listing-title-area">
									
									
									
									
									
									
									
									
									
									
									<form id="edit-service" action="{{ route('worker.service.update', $service->id) }}" method="POST">
										@csrf
										@method('PUT')
										<div class="col-md-12">
											<label>Editar Servicio {{ $service->name }}</label>
										</div>
										
										<input type="hidden" name="service" value="{{ $service->id }}">

										<div class="col-md-4 form-group">
											<div class="intro">
												<label for="day_cost">VALOR HORA DIURNO</label>
												<input class="form-control" id="valor_diurno" name="day_cost" type="text" placeholder="Ingrese VALOR" required value="{{ $service->pivot->day_cost }}">
											</div>
										</div>
										
										<div class="col-md-4 form-group">
											<div class="intro">
												<label for="night_cost">VALOR HORA NOCTURNO</label>
												<input class="form-control" id="valor_nocturno" name="night_cost" type="text" placeholder="Ingrese VALOR" required value="{{ $service->pivot->night_cost }}">
											</div>
										</div>
										
										<div class="col-md-12 form-group">
											<div class="intro">
												<input type="checkbox" name="visit_required" {{ $service->pivot->visit_required ? 'checked' : '' }}>
												<label for="visita">REQUIERE VISITA PREVIA</label>
											</div>
										</div>
										<div class="add-day">
											<div class="col-md-12">
												<h4 class="header-title">DÍAS DISPONIBLES</h4>
												<div class="table-responsive">
													<table class="table table-hover">
														<thead>
															<tr>
																<th>Día</th>
																<th>Horario AM</th>
																<th>Horario PM</th>
																<th>24 horas</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>Lunes</td>
																<td>
																	<input id="lun_am" type="checkbox" name="lun_am" 
																		onclick=" $('#lun_24h').prop('checked', false) "
																		{{ $service->pivot->days->lun_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="lun_pm" type="checkbox" name="lun_pm"
																		onclick=" $('#lun_24h').prop('checked', false) "
																		{{ $service->pivot->days->lun_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="lun_24h" type="checkbox" name="lun_24h"
																		onclick=" $('#lun_am').prop('checked', false); $('#lun_pm').prop('checked', false) "
																		{{ $service->pivot->days->lun_24h ? 'checked' : '' }}>
																</td>
															</tr>
															<tr>
																<td>Martes</td>
																<td>
																	<input id="mar_am" type="checkbox" name="mar_am"
																		onclick=" $('#mar_24h').prop('checked', false) "
																		{{ $service->pivot->days->mar_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="mar_pm" type="checkbox" name="mar_pm"
																		onclick=" $('#mar_24h').prop('checked', false) "
																		{{ $service->pivot->days->mar_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="mar_24h" type="checkbox" name="mar_24h"
																		onclick=" $('#mar_am').prop('checked', false); $('#mar_pm').prop('checked', false) "
																		{{ $service->pivot->days->mar_24h ? 'checked' : '' }}>
																</td>
															</tr>
															<tr>
																<td>Miércoles</td>
																<td>
																	<input id="mie_am" type="checkbox" name="mie_am"
																		onclick=" $('#mie_24h').prop('checked', false) "
																		{{ $service->pivot->days->mie_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="mie_pm" type="checkbox" name="mie_pm"
																		onclick=" $('#mie_24h').prop('checked', false) "
																		{{ $service->pivot->days->mie_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="mie_24h" type="checkbox" name="mie_24h"
																		onclick=" $('#mie_am').prop('checked', false); $('#mie_pm').prop('checked', false) "
																		{{ $service->pivot->days->mie_24h ? 'checked' : '' }}>
																</td>
															</tr>
															<tr>
																<td>Jueves</td>
																<td>
																	<input id="jue_am" type="checkbox" name="jue_am"
																		onclick=" $('#jue_24h').prop('checked', false) "
																		{{ $service->pivot->days->jue_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="jue_pm" type="checkbox" name="jue_pm"
																		onclick=" $('#jue_24h').prop('checked', false) "
																		{{ $service->pivot->days->jue_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="jue_24h" type="checkbox" name="jue_24h"
																		onclick=" $('#jue_am').prop('checked', false); $('#jue_pm').prop('checked', false) "
																		{{ $service->pivot->days->jue_24h ? 'checked' : '' }}>
																</td>
															</tr>
															<tr>
																<td>Viernes</td>
																<td>
																	<input id="vie_am" type="checkbox" name="vie_am"
																		onclick=" $('#vie_24h').prop('checked', false) "
																		{{ $service->pivot->days->vie_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="vie_pm" type="checkbox" name="vie_pm"
																		onclick=" $('#vie_24h').prop('checked', false) "
																		{{ $service->pivot->days->vie_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="vie_24h" type="checkbox" name="vie_24h"
																		onclick=" $('#vie_am').prop('checked', false); $('#vie_pm').prop('checked', false) "
																		{{ $service->pivot->days->vie_24h ? 'checked' : '' }}>
																</td>
															</tr>
															<tr>
																<td>Sábado</td>
																<td>
																	<input id="sab_am" type="checkbox" name="sab_am"
																		onclick=" $('#sab_24h').prop('checked', false) "
																		{{ $service->pivot->days->sab_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="sab_pm" type="checkbox" name="sab_pm"
																		onclick=" $('#sab_24h').prop('checked', false) "
																		{{ $service->pivot->days->sab_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="sab_24h" type="checkbox" name="sab_24h"
																		onclick=" $('#sab_am').prop('checked', false); $('#sab_pm').prop('checked', false) "
																		{{ $service->pivot->days->sab_24h ? 'checked' : '' }}>
																</td>
															</tr>
															<tr>
																<td>Domingo</td>
																<td>
																	<input id="dom_am" type="checkbox" name="dom_am"
																		onclick=" $('#dom_24h').prop('checked', false) "
																		{{ $service->pivot->days->dom_am ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="dom_pm" type="checkbox" name="dom_pm"
																		onclick=" $('#dom_24h').prop('checked', false) "
																		{{ $service->pivot->days->dom_pm ? 'checked' : '' }}>
																</td>
																<td>
																	<input id="dom_24h" type="checkbox" name="dom_24h"
																		onclick=" $('#dom_am').prop('checked', false); $('#dom_pm').prop('checked', false) "
																		{{ $service->pivot->days->dom_24h ? 'checked' : '' }}>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											
											<div class="col-md-12">
												<div class="single-query form-group float_right">
													<a href="" class="float_right" onclick="event.preventDefault(); document.getElementById('edit-service').submit()">
														<i class="fa fa-refresh"></i> Actualizar
													</a>
												</div>
												<div class="single-query form-group float_right">
													<a href="{{ route('worker.services') }}" class="float_right">
														<i class="fa fa-times"></i> Cancelar
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
