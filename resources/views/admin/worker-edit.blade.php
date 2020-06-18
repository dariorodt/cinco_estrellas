@extends('layouts.admin')

@section('title', 'Edición de Trabajador')

@section('css')
@endsection

@section('content')

	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Todos los Trabajadores
				<small>Administración de trabajadores</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.workers') }}">Trabajadores</a></li>
				<li class="active">Todos</li>
			</ol>
		</section>

		{{-- Main content --}}
		<section class="content">
			<div class="row">
				{{-- Widget: user widget style 1 --}}
				<div class="col-md-4">
					<div class="box box-widget widget-user-2">
						{{-- Add the bg color to the header using any of the bg-* classes --}}
						<div class="widget-user-header bg-turquoise2">
							<div class="widget-user-image">
								<img class="img-circle" 
								     src="{{ $worker->profile? asset($worker->profile->image_path) : '' }}" 
								     alt="User Avatar">
							</div>
							{{-- /.widget-user-image --}}
							<h3 class="widget-user-username">
								{{ $worker->profile? $worker->profile->full_name() : 'Sin perfil' }}
							</h3>
							<h5 class="widget-user-desc">
								{{ $worker->profile && $worker->profile->state == 'active' ? 'Activo' : 'Inactivo' }}
							</h5>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<li>
									<a href="#">
										Total Aplicaciones <span class="pull-right badge bg-blue">{{ 
											$worker->applications->count() 
										}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										Servicios Activos <span class="pull-right badge bg-green">{{ 
											$worker->service_orders->where('status', 'active')->count() 
										}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										Servicios Cerrados <span class="pull-right badge bg-yellow">{{ 
											$worker->service_orders->where('status', 'closed')->count() 
										}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										Promedio calificaciones 
										<span class="pull-right badge bg-orange">
											{{ round($worker->ratings->avg('stars'), 1) }}
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<form action="{{ route('admin.worker.update', $worker) }}" method="POST" accept-charset="utf-8">
						@csrf
						@method('PUT')
						@if ($worker->profile)
							@if ($worker->profile->state == 'inactive')
								<button class="btn btn-success" name="active" value="true" type="submit">Activar</button>
							@else
								<button class="btn btn-warning" name="inactive" value="true" type="submit">Desactivar</button>
							@endif
						@endif
					</form>
				</div>
				{{-- /.col --}}
				
				<div class="col-md-8">
					{{-- Custom Tabs --}}
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">Perfil</a></li>
							<li><a href="#tab_2" data-toggle="tab">Aplicaciones</a></li>
							<li><a href="#tab_3" data-toggle="tab">Contrataciones</a></li>
							<li><a href="#tab_4" data-toggle="tab">Calificaciones</a></li>
							<li><a href="#tab_5" data-toggle="tab">Documentos</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								@if ($worker->profile)
									<table class="table">
										<tbody>	
											@php
												$birthday = \Carbon\Carbon::create($worker->profile->birthday);
												$age = $birthday->diffInYears(\Carbon\Carbon::now());
											@endphp
											<tr><td><strong>Nombres</strong></td><td>{{ $worker->profile->f_name }}</td></tr>
											<tr><td><strong>Apellidos</strong></td><td>{{ $worker->profile->l_name }}</td></tr>
											<tr><td><strong>Rut</strong></td><td>{{ $worker->rut }}</td></tr>
											<tr><td><strong>Fecha de Nacimiento</strong></td><td>{{ $birthday->isoFormat('LL') }} ({{ $age }} años)</td></tr>
											<tr><td><strong>Teléfono</strong></td><td>{{ $worker->profile->phone }}</td></tr>
											<tr><td><strong>Sexo</strong></td><td>{{ $worker->profile->gender == 'male'? 'Masculino' : 'Femenino' }}</td></tr>
											<tr><td><strong>Nacionalidad</strong></td><td>{{ $worker->profile->nationality }}</td></tr>
											<tr><td><strong>Comuna</strong></td><td>{{ $worker->profile->comunity }}</td></tr>
											<tr><td><strong>Ciudad</strong></td><td>{{ $worker->profile->city }}</td></tr>
											<tr><td><strong>Calle</strong></td><td>{{ $worker->profile->street }}</td></tr>
											<tr><td><strong>Bloque</strong></td><td>{{ $worker->profile->block }}</td></tr>
											<tr><td><strong>Acerca de mí</strong></td><td>{{ $worker->profile->about_me }}</td></tr>
										</tbody>
									</table>
								@endif
							</div>
							{{-- /.tab-pane --}}
							<div class="tab-pane" id="tab_2">
								<table class="table table-striped">
									<tbody>
										<thead>
											<tr>
												<th>Orden</th>
												<th>Servicio</th>
												<th>Fecha aplicación</th>
												<th>Contratado</th>
											</tr>
										</thead>
										@if ($worker->applications->count())
											@foreach ($worker->applications as $application)
												<tr>
													<td>{{ $application->job->id }}</td>
													<td>{{ $application->job->service->name }}</td>
													<td>{{ date_create($application->created_at)->format('d/m/Y - h:i a') }}</td>
													<td>{!! $application->job->worker_id == $worker->id ? '<span class="label label-success">Si</span>' : '<span class="label label-warning">No</span>' !!}</td>
												</tr>
											@endforeach
										@else
											<tr><td class="text-center" colspan="4">No tiene aplicaciones...</td></tr>
										@endif
									</tbody>
								</table>
							</div>
							{{-- /.tab-pane --}}
							<div class="tab-pane" id="tab_3">
								<table class="table table-striped">
									<tbody>
										<thead>
											<tr>
												<th>Contratante</th>
												<th>Servicio</th>
												<th>Estado</th>
												<th>Inicio</th>
												<th>Fin</th>
												<th>Región</th>
											</tr>
										</thead>
										@if ($worker->service_orders->count())
											@foreach ($worker->service_orders as $order)
												<tr>
													<td>{{ $order->client->profile->full_name() }}</td>
													<td>{{ $order->service->name }}</td>
													<td>{{ $order->status == 'open'? 'Abierta': ($order->status == 'active'? 'Activa': ($order->status == 'closed'? 'Cerrada' : 'Cancelada')) }}</td>
													<td>{{ \Carbon\Carbon::create($order->starting_date)->isoFormat('L') }}</td>
													<td>{{ \Carbon\Carbon::create($order->ending_date)->isoFormat('L') }}</td>
													<td>{{ $order->region }}</td>
												</tr>
											@endforeach
										@else
											<tr><td class="text-center" colspan="6">No tiene contrataciones...</td></tr>
										@endif
									</tbody>
								</table>
							</div>
							{{-- /.tab-pane --}}
							<div class="tab-pane" id="tab_4">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Orden de servicio</th>
											<th>Cliente</th>
											<th>Calificación</th>
											<th>Comentario</th>
										</tr>
									</thead>
									<tbody>
										@if ($worker->ratings->count())
											@foreach ($worker->ratings as $rating)
												<tr>
													<td>#{{ $rating->service_order_id }} - {{ $rating->service_order->service->name }}</td>
													<td>{{ $rating->user->profile->full_name() }}</td>
													<td><span class="rateit" data-rateit-value="{{ $rating->stars }}" data-rateit-ispreset="true" data-rateit-readonly="true"></span></td>
													<td>{{ $rating->comment }}</td>
												</tr>
											@endforeach
										@else
											<tr><td class="text-center" colspan="4">No tiene calificaciones...</td></tr>
										@endif
									</tbody>
								</table>
							</div>
							{{-- /.tab-pane --}}
							<div class="tab-pane" id="tab_5">
								<div class="well documents">
									@foreach ($worker->documents as $document)
										<div class="thumbnail document">
											@if ($document->file_type == 'img')
												<img src="{{ asset($document->file_path) }}">
											@else
												<img src="{{ asset('images/pdf-document.jpg') }}">
											@endif
											<div class="caption">
												<h4>{{ $document->name }}</h4>
												<p>
													{{ $document->comment }}
												</p>
												<a class="btn btn-default btn-xs" 
													href="{{ asset($document->file_path) }}" 
													target="_blank">Ver</a>
											</div>
										</div>
									@endforeach
								</div>
							</div>
							{{-- /.tab-pane --}}
						</div>
						{{-- /.tab-content --}}
					</div>
					{{-- nav-tabs-custom --}}
				</div>
				{{-- /.col --}}
			</div>
		</section>
	</div>
@endsection

@section('scripts')

<script type="text/javascript">	
	(function() {
		document.getElementById('worker_menu').classList.add('active');
		document.getElementById('worker_list_menu').classList.add('active');
	})();
</script>

@endsection