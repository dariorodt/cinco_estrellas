@extends('layouts.admin')

@section('title', 'Contenido Página de Inicio')

@section('css')
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Página de Inicio
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Inicio</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			
			<div class="row">
				<!-- form start -->
				<form role="form" action="{{ route('admin.welcome.store') }}" method="POST" 
				      enctype="multipart/form-data">
					@csrf
					
					{{-- Left Column --}}
					<div class="col-md-6">
						{{-- Telf y correo de contacto  --}}
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Email y teléfono de contacto</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<label for="email">Dirección de Email</label>
									<input type="text" class="form-control" name="email" 
									       value="{{ $content->email }}">
								</div>
								
								<div class="form-group">
									<label for="phone">Teléfono</label>
									<input type="text" class="form-control" name="phone" 
									       value="{{ $content->phone }}">
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
						
						{{-- URL de redes sociales. --}}
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Redes sociales</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="facebook">URL de Facebook <i class="fa fa-facebook-square"></i></label>
									<input type="text" name="facebook" class="form-control" 
									       value="{{ $content->facebook }}">
								</div>
								<div class="form-group">
									<label for="instagram">URL de Instagram <i class="fa fa-instagram"></i></label>
									<input type="text" name="instagram" class="form-control" 
									       value="{{ $content->instagram }}">
								</div>
								<div class="form-group">
									<label for="twitter">URL de Twitter <i class="fa fa-twitter-square"></i></label>
									<input type="text" name="twitter" class="form-control" 
									       value="{{ $content->twitter }}">
								</div>
							</div>
						</div>
					</div>
					
					{{-- Right Column --}}
					<div class="col-md-6">
						{{-- Mensaje del cover y el enlace  --}}
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Acción de la Portada</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="cover_image">Imagen de la portada</label>
									<p>Click sobre la imágen para seleccionar...</p>
									<img id="cover-image" src="{{ asset($content->cover_image) }}" 
									     alt="{{ $content->cover_image }}" width="100%" height="100" 
									     style="object-fit: cover; cursor: pointer;"
									     onclick="$('#cover_image').click()">
									<input style="display: none;" id="cover_image" name="cover_image" 
									       type="file" onchange="loadImage(this, 'cover-image')">
								</div>
								<div class="form-group">
									<label for="cover_title">Título de la portada</label>
									<input type="text" name="cover_title" class="form-control" 
									       value="{{ $content->cover_title }}">
								</div>
								<div class="form-group">
									<label for="cover_message">Mensaje de portada</label>
									<input type="text" name="cover_message" class="form-control" 
									       value="{{ $content->cover_message }}">
								</div>
								<div class="form-group">
									<label for="cover_link">Enlace</label>
									<input type="text" name="cover_link" class="form-control" 
									       value="{{ $content->cover_link }}">
								</div>
								<div class="form-group">
									<label for="cover_link_text">Texto del enlace</label>
									<input type="text" name="cover_link_text" class="form-control" 
									       value="{{ $content->cover_link_text }}">
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-12" style="margin-bottom: 20px;">
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-upload"></i> Actualizar
						</button>
					</div>
					
				</form>
			</div>
			
			
		</section>
	</div>
@endsection

@section('scripts')

<script>
	
	(function() {
		document.getElementById('pages_menu').classList.add('active');
		document.getElementById('main_page_menu').classList.add('active');
	})();
	
	/**
	 * When the input control changes this function update the image 
	 * shown in de preview control.
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
	
</script>

@endsection