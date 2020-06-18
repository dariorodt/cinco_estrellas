@extends('layouts.admin')

@section('title', 'Crear Usuario Admin')

@section('css')
@endsection

@section('content')
	
	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Crear Usuario Admin
				<small>Administración de Usuarios Admin</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.adminusers') }}">Usuarios Admin</a></li>
				<li class="active">Crear</li>
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
							<h3 class="box-title">Crear nuevo Usuario Admin</h3>
						</div>
						
						<div class="box-body">
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form role="form" action="{{ route('admin.adminuser.store') }}" method="POST">
										@csrf
										<div class="form-group">
											<label for="role_id" class="control-label">Seleccione un rol</label>
											<select name="role_id" class="form-control" required>
												<option value="0" selected disabled>Seleccione un rol</option>}
												@foreach (App\Role::all() as $role)
													<option value="{{ $role->id }}">{{ $role->name }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="name" class="control-label">Nombre de usuario</label>
											<input type="text" name="name" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="email" class="control-label">Email</label>
											<input type="email" name="email" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="password" class="control-label">Password</label>
											<input type="password" name="password" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="password" class="control-label">Confoimar Password</label>
											<input type="password" name="password_confirmation" class="form-control" required>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i> Crear</button>
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