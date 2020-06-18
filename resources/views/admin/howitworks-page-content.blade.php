@extends('layouts.admin')

@section('title', 'Contenido Página de Cómo Funciona')

@section('css')
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Página de Cómo Funciona
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Cómo Funciona</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<form action="{{ route('admin.howitworks.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					
					{{-- Left Column --}}
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Call to action #1</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="email">Imagen de fondo</label>
									<p>Click sobre la imágen para seleccionar...</p>
									<img id="cta1-image" src="{{ asset($content->cta1_image) }}" 
									     alt="{{ $content->cta1_image }}" width="100%" height="100" 
									     style="object-fit: cover; cursor: pointer;"
									     onclick="$('#cta1_image').click()">
									<input style="display: none;" id="cta1_image" name="cta1_image" 
									       type="file" onchange="loadImage(this, 'cta1-image')">
								</div>
								
								<div class="form-group">
									<label for="cta1_title">Titulo</label>
									<input type="text" class="form-control" name="cta1_title" 
									       value="{{ $content->cta1_title }}">
								</div>
							</div>
						</div>
					</div>
					{{-- Right Column --}}
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header with">
								<h3 class="box-title">Call to action #2</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="cta2_image">Imagen de fondo</label>
									<p>Click sobre la imágen para seleccionar...</p>
									<img id="cta2-image" src="{{ asset($content->cta2_image) }}" 
									     alt="{{ $content->cta2_image }}" width="100%" height="100" 
									     style="object-fit: cover; cursor: pointer;"
									     onclick="$('#cta2_image').click()">
									<input style="display: none;" id="cta2_image" name="cta2_image" 
									       type="file" onchange="loadImage(this, 'cta2-image')">
								</div>
								
								<div class="form-group">
									<label for="cta2_title">Titulo</label>
									<input type="text" class="form-control" name="cta2_title" 
									       value="{{ $content->cta2_title }}">
								</div>
								
								<div class="form-group">
									<label for="cta2_text">Texto</label>
									<input type="text" class="form-control" name="cta2_text" 
									       value="{{ $content->cta2_text }}">
								</div>
								
								<div class="form-group">
									<label for="cta2_btn_text">Texto botón</label>
									<input type="text" class="form-control" name="cta2_btn_text" 
									       value="{{ $content->cta2_btn_text }}">
								</div>
								
								<div class="form-group">
									<label for="cta2_btn_link">Enlace botón</label>
									<input type="text" class="form-control" name="cta2_btn_link" 
									       value="{{ $content->cta2_btn_link }}">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<button class="btn btn-primary"><i class="fa fa-upload"></i> Actualizar</button>
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
		document.getElementById('howto_page_menu').classList.add('active');
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