@extends('layouts.admin')

@section('title', 'Administración de Trabajadores')

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
							<h3 class="box-title">Lista completa de trabajadores</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="worker-list" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>E-Mail</th>
										<th>RUT</th>
										<th>Estado</th>
										<th>Creado el</th>
										<th width="40">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($workers as $worker)
										<tr>
											<td>{{ $worker->profile? $worker->profile->f_name.' '.$worker->profile->l_name : 'Sin perfil...' }}</td>
											<td>{{ $worker->email }}</td>
											<td>{{ $worker->rut }}</td>
											<td>
												@if ($worker->profile && $worker->profile->state == 'active')
													<span class="label label-success">Active</span>
												@elseif($worker->profile && $worker->profile->state == 'inactive')
													<span class="label label-warning">Incative</span>
												@else
													<span class="label label-danger">Sin perfil...</span>
												@endif
											</td>
											<td>{{ $worker->created_at }}</td>
											<td>
												<a href="{{ route('admin.worker.edit', $worker) }}" class="btn btn-primary btn-xs">
													<i class="fa fa-edit"></i>
												</a>
												<form action="{{ route('admin.worker.delete', $worker) }}" method="POST" style="display:inline;">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Nombre</th>
										<th>E-Mail</th>
										<th>RUT</th>
										<th>Estado</th>
										<th>Creado el</th>
										<th>Acciones</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
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
		$('#worker-list').DataTable({
			'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		})
	});
	
	(function() {
		var view = window.location.pathname.slice(15);
		
		document.getElementById('worker_menu').classList.add('active');
		
		if(view == 'new-workers') {
			document.getElementById('worker_new_menu').classList.add('active');
		}
		
		else if(view == 'active-workers') {
			document.getElementById('worker_active_menu').classList.add('active');
		}
		
		else {
			document.getElementById('worker_list_menu').classList.add('active');
		}
	})();
	
</script>

@endsection
