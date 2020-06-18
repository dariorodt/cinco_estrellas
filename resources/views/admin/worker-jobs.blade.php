@extends('layouts.admin')

@section('title', 'Trabajos Activos')

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
				Todos los Trabajadores
				<small>Administración de trabajadores</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Trabajadores</li>
				<li class="active">Todos</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Trabajos Aceptados</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="job-list" class="table table-striped">
								<thead>
									<tr>
										<th>Cliente</th>
										<th>Trabajador</th>
										<th>Servicio</th>
										<th>Estado</th>
										<th>Fechas</th>
										<th>Horario</th>
										<th>Localidad</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($jobs as $job)
										<tr>
											<td>{{ $job->client->profile->full_name() }}</td>
											<td>{{ $job->worker->profile->full_name() }}</td>
											<td>{{ $job->service->name }}</td>
											<td>{!! $job->status == 'active' ? '<span class="label label-success">Activa</span>' : '<span class="label label-warning">Cerrada</span>' !!}</td>
											<td>
												{{ \Carbon\Carbon::create($job->starting_date)->isoFormat('L') }} 
												al {{ \Carbon\Carbon::create($job->ending_date)->isoFormat('L') }}
											</td>
											<td>{{ date_create($job->starting_time)->format('h:i a') }} a {{ date_create($job->ending_time)->format('h:i a') }}</td>
											<td>{{ $job->city }}</td>
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
	$(function () {
		
		document.getElementById('worker_menu').classList.add('active');
		document.getElementById('worker_jobs_menu').classList.add('active');
		
		$('#job-list').DataTable({
			'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		})
	});
</script>

@endsection

