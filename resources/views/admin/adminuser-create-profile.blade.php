@extends('layouts.admin')

@section('title', 'Crear Perfil de Usuario Admin')

@section('css')
@endsection

@section('content')
	
	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Crear Perfil de Usuario Admin
				<small>Administración de Usuarios Admin</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.adminusers') }}">Usuarios Admin</a></li>
				<li><a href="{{ route('admin.adminuser.edit', $admin) }}">Usuario {{ $admin->name }}</a></li>
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
									<form role="form" action="{{ route('admin.adminuser.store_profile', $admin) }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<label for="name">Nombre del Admin</label>
											<input type="text" name="name" class="form-control" required>
											@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
										<div class="form-group">
											<label for="image">Seleccione una imagen</label>
											<input type="file" name="image" accept="image/*" required>
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