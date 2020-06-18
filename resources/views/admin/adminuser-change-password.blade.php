@extends('layouts.admin')

@section('title', 'Cambiar Password Usuario Admin')

@section('css')
@endsection

@section('content')
	
	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Cambiar Password Usuario Admin
				<small>Administración de Usuarios Admin</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="{{ route('admin.adminusers') }}">Usuarios Admin</a></li>
				<li><a href="{{ route('admin.adminuser.edit', $admin) }}">Usuario {{ $admin->name }}</a></li>
				<li class="active">Cambiar Password</li>
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
							<h3 class="box-title">Cambiar Password Admin</h3>
						</div>
						
						<div class="box-body">
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form role="form" action="{{ route('admin.adminuser.ch_password', $admin) }}" method="POST">
										@csrf
										@method('PUT')
										<div class="form-group">
											<label for="password" class="control-label">Password</label>
											<input type="password" name="password" class="form-control" required>
											@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
										<div class="form-group">
											<label for="password" class="control-label">Confirmar Password</label>
											<input type="password" name="password_confirmation" class="form-control" required>
										</div>
										<div class="form-group">
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