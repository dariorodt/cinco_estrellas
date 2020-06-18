@extends('layouts.admin')

@section('title', 'Aplicaciones')

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
				Todas las aplicaciones
				<small>Administración de trabajadores</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.workers') }}">Trabajadores</a></li>
				<li class="active">Aplicaciones</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Aplicaciones a trabajos</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="job-list" class="table table-striped">
								<thead>
									<tr>
										<th>Trabajador</th>
										<th>Orden</th>
										<th>Cliente</th>
										<th>Contratado</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($applications as $app)
										<tr>
											<td>{{ $app->worker->profile->full_name() }}</td>
											<td>{{ $app->job_id }} - {{ $app->job->service->name }}</td>
											<td>{{ $app->job->client->profile->full_name() }}</td>
											<td>{!! $app->job->worker_id == $app->worker_id ? '<span class="label label-success">Si</span>' : '<span class="label label-warning">No</span>' !!}</td>
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
		document.getElementById('worker_appl_menu').classList.add('active');
		
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

