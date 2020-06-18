@extends('layouts.admin')

@section('title', 'Crear Servicio')

@section('css')
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
				<li><a href="{{ route('admin.services') }}">Servicios</a></li>
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
							<h3 class="box-title">Crear nuevo servicio</h3>
						</div>
						
						<div class="box-body">
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form role="form" action="{{ route('admin.service.store') }}" method="POST">
										@csrf
										<div class="form-group">
											<label for="fa-icon">Elija un icono representativo</label>
											<select id="icon-select" name="fa_icon" class="form-control" 
											        onchange="
											        	$('#icon').removeClass();
											        	$('#icon').addClass('fa ' + $('#icon-select').val())
											        ">
												@foreach ($fa_icon_list as $fa_icon)
													<option value="{{ $fa_icon }}"> {{ $fa_icon }}</option>
												@endforeach
											</select>
											<i id="icon" class="fa fa-home" style="font-size: 50px; margin-top: 5px"></i>
										</div>
										<input type="hidden" name="status" value="active">
										<div class="form-group">
											<label for="name">Nombre que desea dar al servicio</label>
											<input type="text" name="name" class="form-control" required autofocus>
										</div>
										<div class="form-group">
											<label for="description">Descripción corta del servicio (255 caracteres)</label>
											<input type="text" name="description" class="form-control" required>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i> Enviar</button>
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

