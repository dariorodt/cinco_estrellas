@extends('layouts.admin')

@section('title', 'Servicios')

@section('css')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
	
	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Todos los Servicios
				<small>Administración de Servicios</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.content.services') }}">Servicios</a></li>
				<li class="active">Activos</li>
			</ol>
		</section>

		{{-- Main content --}}
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					
					@if (session('success'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> ¡Éxito!</h4>
							{{ session('success') }}.
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-warning"></i> ¡Advertencia!</h4>
							{{ session('warning') }}.
						</div>
					@endif
					
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Servicios activos actualmente</h3>
							<a class="btn btn-primary pull-right" href="{{ route('admin.service.create') }}" title="Nuevo Servicio"><i class="fa fa-plus"></i> Nuevo Servicio</a>
						</div>
						{{-- /.box-header --}}
						<div class="box-body">
							
							<table id="services" class="table table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre servicio</th>
										<th>Descripción</th>
										<th>#Trabajadores</th>
										<th>#Solicitudes</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($services as $service)
										<tr>
											<td>#{{ $service->id }}</td>
											<td>{{ $service->name }}</td>
											<td>{{ $service->description }}</td>
											<td>{{ $service->workers->count() }}</td>
											<td>{{ \App\ServiceOrder::where('service_id', $service->id)->count() }}</td>
											@if ($service->status == 'active')
												<td><span class="label label-success">Activo</span></td>
											@else
												<td><span class="label label-warning">Inactivo</span></td>
											@endif
											<td>
												<a href="{{ route('admin.service.edit', $service) }}" class="btn btn-primary btn-xs">
													<i class="fa fa-edit"></i>
												</a>
												<form action="{{ route('admin.service.delete', $service) }}" method="POST" style="display:inline;">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
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
	
	/**
	 * Autoload function
	 */
	$(function () {
		$('#services').DataTable({
			'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		})
		
		document.getElementById('service_menu').classList.add('active');
		document.getElementById('service_active_menu').classList.add('active');
	});
	
</script>
@endsection