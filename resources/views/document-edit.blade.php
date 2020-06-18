@extends('layouts.site')

@section('title', 'Edición de Documento')

@section('css')
@endsection

@section('content')

	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Mi Perfil</h2>
						<p><a href="index.html">Home</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Perfil</p>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Profile -->
	<section id="listing-details" class="p_b70 p_t70 bg_lightgry">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="profile-leftbar">
						<div id="profile-picture" class="profile-picture">
							@if ($user->profile)
								<img src="{{ asset($user->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					@component('partials.client-panel-menu')
					@endcomponent
				</div>

				<div class="col-md-9 col-sm-9 col-xs-12">
					@foreach ($errors->all() as $message)
						<div class="alert alert-warning">
							{{ $message }}
						</div>
					@endforeach
					
					@if (session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('success') }}
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('warning') }}
						</div>
					@endif
					
					<div class="profile-login-bg">
						<h2><span><i class="fa fa-files"></i></span> Editar <span>Documento</span></h2>
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="row">
									
									<form action="{{ route('user.document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
										@csrf
										@method('PUT')
										<div class="col-md-4">
											@if ($document->file_type == 'pdf')
											<img id="document_image" onclick="selectImage('file_input')" src="{{ asset('images/pdf-document.jpg') }}" width="100%" height="100%">
											@else
											<img id="document_image" onclick="selectImage('file_input')" src="{{ asset($document->file_path) }}" width="100%" height="100%">
											@endif
											<input style="display: none;" 
												id="file_input" 
												name="document_image" 
												type="file" 
												onchange="loadImage(this, 'document_image')">
										</div>
										
										<div class="col-md-8">
											
											<input type="hidden" name="user_id" value="{{ Auth::id() }}">
											<div class="form-group">
												<label for="name">Nombre del documento</label>
												<input class="form-control" type="text" name="name" value="{{ $document->name }}" required="">
											</div>
											
											<div class="form-group">
												<label for="comment">Comentario breve</label>
												<input class="form-control" type="text" name="comment" value="{{ $document->comment }}" required="">
											</div>
											
											<div class="form-group">
												<label>Seleccione el tipo de documento</label>
												<select class="form-control" name="file_type">
													<option value="img" {{ $document->file_type == 'img' ? 'selected' : '' }}>Imagen de documento</option>
													<option value="pdf"{{ $document->file_type == 'pdf' ? 'selected' : '' }}>Documento portable (pdf)</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group pull-right">
												<button class="form-control" type="submit"><i class="fa fa-upload"></i> Actualizar</button>
											</div>
										</div>
									</form>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section('scripts')

	<script>
		
		/**
		 * When the user clicks on the image element the event is transferred
		 * to the input control.
		 */
		function selectImage(input) {
			console.log('Image container clicked');
			document.getElementById(input).click();
		}
		
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
					if (extension == 'pdf') {
						image.src = '/images/pdf-document.jpg';
					} else {
						image.src = e.target.result;
					}
					image.style.display = 'block';
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
		
	</script>

@endsection

@section('scripts')
@endsection

