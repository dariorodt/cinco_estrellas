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
									<form role="form" action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
										@csrf
										
										
										
										{{-- <div class="form-group">
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
										</div> --}}
										
										
										<div class="form-group">
											<label>Selecciones una imagen para la categoría</label>
											<p class="help-block">Debe ser un archivo de imagen en formato .PNG con fondo transparente.</p>
											
											<img src="{{ asset('images/best-thing-8.jpg') }}" alt="" 
											     id="profile_picture" onclick="selectImage('pi-input')" 
											     width="100" height="auto" style="object-fit: cover;">
											@error('icon')
											<p class="text-danger">{{ $message }}</p>
											@enderror
											
											<input style="display: none;" id="pi-input" name="icon" type="file" accept=".png" 
											       onchange="loadImage(this, 'profile_picture')">
											
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
	<script type="text/javascript">
		/**
		 * When the file input control changesits state 
		 * this function updates the image shown in de 
		 * preview control.
		 */
		function loadImage(input, preview) {
			
			console.log('loadImage: called from' + input);
			
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var image = document.getElementById(preview);

				reader.onload = function (e) {
					image.src = e.target.result;
					image.style.display = 'block';
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
		
		/**
		 * Open the select file dialog when the preview image control 
		 * is clicked.
		 */
		function selectImage(input) {
			console.log('Image container clicked');
			document.getElementById(input).click();
		}
	</script>
@endsection

