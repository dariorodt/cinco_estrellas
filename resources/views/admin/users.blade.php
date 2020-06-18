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
				Todos los Usuarios
				<small>Administración de usuarios</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.users') }}">Usuarios</a></li>
				<li class="active">Todos</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Data Table With Full Features</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="user-list" class="table table-bordered table-striped">
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
									@foreach ($users as $user)
										<tr>
											<td><a href="{{ route('admin.user.edit', $user) }}">{{ $user->profile? $user->profile->full_name() : '' }}</a></td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->profile? $user->profile->rut : 'Sin perfil...' }}</td>
											<td>
												@if ($user->profile)
													@if ($user->profile->status == 'active')
														<span class="label label-success">Active</span>
													@else
														<span class="label label-warning">Incative</span>
													@endif
												@else
													<span class="label label-danger">Sin perfil...</span>
												@endif
											</td>
											<td>{{ $user->created_at }}</td>
											<td>
												<a href="{{ route('admin.user.edit', $user) }}" class="btn btn-primary btn-xs">
													<i class="fa fa-edit"></i>
												</a>
												<form action="{{ route('admin.user.delete', $user) }}" method="POST" style="display:inline;">
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
		
		var view = window.location.pathname.slice(13);
		
		document.getElementById('user_menu').classList.add('active');
		
		if(view == 'new-users') {
			document.getElementById('user_new_menu').classList.add('active');
		}
		
		else if(view == 'active-users') {
			document.getElementById('user_active_menu').classList.add('active');
		}
		
		else {
			document.getElementById('user_list_menu').classList.add('active');
		}
		
	})();
	
</script>

@endsection