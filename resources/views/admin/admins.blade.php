@extends('layouts.admin')

@section('title', 'Usuarios Administradores')

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
				Todos los Administradores
				<small>Administración de usuarios</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.adminusers') }}">Administradores</a></li>
				<li class="active">Todos</li>
			</ol>
		</section>

		<!-- Main content -->
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
						<div class="box-header">
							<h3 class="box-title">Usuarios Administradores</h3>
							<a href="{{ route('admin.adminuser.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Nuevo</a>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="user-list" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>E-Mail</th>
										<th>Estado</th>
										<th>Creado el</th>
										<th width="40">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($admins as $user)
										<tr>
											<td><a href="{{ route('admin.user.edit', $user) }}">{{ $user->name }}</a></td>
											<td>{{ $user->email }}</td>
											<td>
												@if ($user->profile)
													@if ($user->profile->state == 'active')
														<span class="label label-success">Active</span>
													@else
														<span class="label label-warning">Incative</span>
													@endif
												@else
													<a href="{{ route('admin.adminuser.create_profile', $user) }}"><span class="label label-danger">Sin perfil...</span></a>
												@endif
											</td>
											<td>{{ $user->created_at }}</td>
											<td>
												<a href="{{ route('admin.adminuser.edit', $user) }}" class="btn btn-primary btn-xs">
													<i class="fa fa-edit"></i>
												</a>
												<form action="{{ route('admin.adminuser.delete', $user) }}" method="POST" style="display:inline;">
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
		});
		
	});
	
	(function() {
		document.getElementById('admins_menu').classList.add('active');
	})();
</script>
@endsection