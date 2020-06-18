@extends('layouts.site')

@section('title', 'Subir Documento')

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
						<h2><span><i class="fa fa-files"></i></span> Registrar <span>Documento</span></h2>
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="row">
									
									<form action="{{ route('user.document.add') }}" method="POST" enctype="multipart/form-data">
										@csrf
										
										<div class="col-md-4">
											<img id="document_image" onclick="selectImage('file_input')" src="{{ asset('images/profile.jpg') }}" width="100%" height="100%">
											<input style="display: none;" 
												id="file_input" 
												name="document_image" 
												type="file" 
												onchange="loadImage(this, 'document_image')" accept="image/*, application/pdf">
										</div>
										
										<div class="col-md-8">
											
											<input type="hidden" name="user_id" value="{{ Auth::id() }}">
											<div class="form-group">
												<label for="name">Nombre del documento</label>
												<input class="form-control" type="text" name="name" placeholder="Nombre del documento" required="">
											</div>
											
											<div class="form-group">
												<label for="comment">Comentario breve</label>
												<input class="form-control" type="text" name="comment" placeholder="Comentario corto" required="">
											</div>
											
											<div class="form-group">
												<label>Seleccione el tipo de documento</label>
												<select class="form-control" name="file_type">
													<option value="img">Imagen de documento</option>
													<option value="pdf">Documento portable (pdf)</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group pull-right">
												<button class="form-control" type="submit"><i class="fa fa-upload"></i> Registrar</button>
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
			
			var extension = input.files[0].name.split('.').pop().toLowerCase();
			console.log('loadImage: called from' + input);
			console.log('with extension: ' + extension);
			
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

