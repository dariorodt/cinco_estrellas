@extends('layouts.admin')

@section('title', 'Editar Usuario Admin')

@section('css')
@endsection

@section('content')
	
	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Editar Usuario Admin
				<small>Administración de Usuarios Admin</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.adminusers') }}">Usuarios Admin</a></li>
				<li class="active">Editar</li>
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
							{{ $success }}.
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-warning"></i> ¡Éxito!</h4>
							{{ $warning }}.
						</div>
					@endif
					
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Editar Usuario Admin</h3>
						</div>
						
						<div class="box-body">
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form role="form" action="{{ route('admin.adminuser.update', $admin) }}" method="POST">
										@csrf
										@method('PUT')
										<div class="form-group">
											<label for="role_id" class="control-label">Seleccione un rol</label>
											<select name="role_id" class="form-control" required>
												@foreach (App\Role::all() as $role)
													<option value="{{ $role->id }}" {{ $admin->role_id == $role->id? 'selected' : '' }}>
														{{ $role->name }}
													</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="name" class="control-label">Nombre de usuario</label>
											<input type="text" name="name" class="form-control" value="{{ $admin->name }}">
										</div>
										<div class="form-group">
											<label for="email" class="control-label">Email</label>
											<input type="email" name="email" class="form-control" value="{{ $admin->email }}">
										</div>
										<div class="form-group">
											<a href="{{ route('admin.adminuser.ch_password', $admin) }}" class="btn btn-warning"><i class="fa fa-lock"></i> Cambiar Password</a>
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i> Actualizar</button>
										</div>
									</form>
								</div>
								<div class="col-md-3"></div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection

@section('scripts')
@endsection