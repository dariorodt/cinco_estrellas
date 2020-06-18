@extends('layouts.admin')

@section('title', 'Administración de Usuarios')

@section('css')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Editar Usuarios
				<small>Administración de usuarios</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.users') }}">Usuarios</a></li>
				<li class="active">Editar</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				{{-- Widget: user widget style 1 --}}
				<div class="col-md-4">
					<div class="box box-widget widget-user-2">
						{{-- Add the bg color to the header using any of the bg-* classes --}}
						<div class="widget-user-header bg-turquoise2">
							<div class="widget-user-image">
								<img class="img-circle" 
								     src="{{ $user->profile? asset($user->profile->image_path) : '' }}" 
								     alt="User Avatar">
							</div>
							{{-- /.widget-user-image --}}
							<h3 class="widget-user-username">
								{{ $user->profile? $user->profile->full_name() : 'Sin perfil' }}
							</h3>
							<h5 class="widget-user-desc">
								{{ $user->profile && $user->profile->status == 'active' ? 'Activo' : 'Inactivo' }}
							</h5>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<li>
									<a href="#">
										Total Solicitudes <span class="pull-right badge bg-blue">{{ 
											$user->service_orders->count() 
										}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										Activas <span class="pull-right badge bg-aqua">{{ 
											$user->service_orders->where('status', 'active')->count() 
										}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										Cerradas <span class="pull-right badge bg-green">{{ 
											$user->service_orders->where('status', 'closed')->count() 
										}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										Calificación promedio 
										<span class="pull-right badge bg-orange">
											{{ round($user->ratings->avg('stars'), 1) }}
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<form action="{{ route('admin.user.update', $user) }}" method="POST" accept-charset="utf-8">
						@csrf
						@method('PUT')
						@if ($user->profile)
							@if ($user->profile->status == 'inactive')
								<button class="btn btn-success" name="active" value="true" type="submit">Activar</button>
							@else
								<button class="btn btn-warning" name="inactive" value="true" type="submit">Desactivar</button>
							@endif
						@endif
					</form>
				</div>
				<div class="col-md-8">
					{{-- Custom Tabs --}}
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">Perfil</a></li>
							<li><a href="#tab_2" data-toggle="tab">Trabajos publicados</a></li>
							<li><a href="#tab_3" data-toggle="tab">Calificaciones</a></li>
							<li><a href="#tab_4" data-toggle="tab">Documentos</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
							@if ($user->profile)
								<table class="table">
									<tbody>	
										@php
											$birthday = \Carbon\Carbon::create($user->profile->birthday);
											$age = $birthday->diffInYears(\Carbon\Carbon::now());
										@endphp
										<tr><td><strong>Nombres</strong></td><td>{{ $user->profile->f_name }}</td></tr>
										<tr><td><strong>Apellidos</strong></td><td>{{ $user->profile->l_name }}</td></tr>
										<tr><td><strong>Rut</strong></td><td>{{ $user->profile->rut }}</td></tr>
										<tr><td><strong>Fecha de Nacimiento</strong></td><td>{{ $birthday->isoFormat('LL') }} ({{ $age }} años)</td></tr>
										<tr><td><strong>Teléfono</strong></td><td>{{ $user->profile->phone }}</td></tr>
										<tr><td><strong>Sexo</strong></td><td>{{ $user->profile->gender == 'male'? 'Masculino' : 'Femenino' }}</td></tr>
										<tr><td><strong>Nacionalidad</strong></td><td>{{ $user->profile->nationality }}</td></tr>
										<tr><td><strong>Comuna</strong></td><td>{{ $user->profile->comunity }}</td></tr>
										<tr><td><strong>Ciudad</strong></td><td>{{ $user->profile->city }}</td></tr>
										<tr><td><strong>Calle</strong></td><td>{{ $user->profile->street }}</td></tr>
										<tr><td><strong>Bloque</strong></td><td>{{ $user->profile->block }}</td></tr>
										<tr><td><strong>Acerca de mí</strong></td><td>{{ $user->profile->about_me }}</td></tr>
									</tbody>
								</table>
							@endif
							</div>
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_2">
								<table class="table table-striped">
									<tbody>
										<thead>
											<tr>
												<th>Trabajador</th>
												<th>Servicio</th>
												<th>Estado</th>
												<th>Inicio</th>
												<th>Fin</th>
												<th>Región</th>
											</tr>
										</thead>
										@foreach ($user->service_orders as $order)
											<tr>
												<td>{{ $order->worker_id ? $order->worker->profile->full_name() : 'No tiene' }}</td>
												<td>{{ $order->service->name }}</td>
												<td>{{ $order->status == 'open'? 'Abierta': ($order->status == 'active'? 'Activa': ($order->status == 'closed'? 'Cerrada' : 'Cancelada')) }}</td>
												<td>{{ \Carbon\Carbon::create($order->starting_date)->isoFormat('L') }}</td>
												<td>{{ \Carbon\Carbon::create($order->ending_date)->isoFormat('L') }}</td>
												<td>{{ $order->region }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_3">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Orden de servicio</th>
											<th>Trabajador</th>
											<th>Calificación</th>
										</tr>
									</thead>
									<tbody>
										@if ($user->ratings->count())
											@foreach ($user->ratings as $rating)
												<tr>
													<td>{{ $rating->service_order_id }}</td>
													<td>{{ $rating->sender_id }}</td>
													<td><span class="rateit" data-rateit-value="{{ $rating->stars }}" data-rateit-ispreset="true" data-rateit-readonly="true"></span></td>
												</tr>
											@endforeach
										@else
											<tr><td colspan="3">No hay calificaciones...</td></tr>
										@endif
									</tbody>
								</table>
							</div>
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_4">
								<div class="well documents">
									@foreach ($user->documents as $document)
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
							<!-- /.tab-pane -->
						</div>
						<!-- /.tab-content -->
					</div>
					<!-- nav-tabs-custom -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
	</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>

<script>
	
	$(function () {
		$('#user-list').DataTable({
			'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		})
	});
	
	(function() {
		document.getElementById('user_menu').classList.add('active');
		document.getElementById('user_list_menu').classList.add('active');
	})();
	
</script>

@endsection