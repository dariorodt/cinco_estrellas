@extends('layouts.site')

@section('title', 'Mi Perfil')

@section('css')
@endsection

@section('content')	
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Mi Perfil</h2>
						<p><a href="{{ url('/') }}">Home</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Perfil</p>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section id="profile" class="p_b70 p_t70 bg_lightgry">

		<div class="container">
			<div class="row">

				<form id="profile_form" action="{{ route('worker.update_profile') }}" method="POST" enctype="multipart/form-data">
					@csrf
				
					{{-- Aside menu section --}}
					<div class="col-md-3 col-sm-3 col-xs-12">

						<div class="profile-leftbar">
							
							{{-- Beneath code replace the above commented code sniped because dropzone.js doen't work properly --}}
							
							<div id="profile-picture">
								@if ($user->profile && $user->profile->image_path)
									<img id="profile_picture" onclick="selectImage('pi-input')" src="{{ asset($user->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
								@else
									<img id="profile_picture" onclick="selectImage('pi-input')" src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
								@endif
								<input 
									style="display: none;" 
									id="pi-input" 
									name="prof_img" 
									type="file" 
									onchange="loadImage(this, 'profile_picture')">
							</div>
							
						</div>

						@component('partials.worker-panel-menu')
						@endcomponent

					</div>
					{{-- Aside menu section --}}
					

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
						
						@if (!Auth::user()->profile || Auth::user()->profile->state == 'inactive')
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4><i class="fa fa-warning"></i> ¡Advertencia!</h4>
								Su estado actual es «INACTIVO», por lo tanto, usted no podrá ofrecer servicios ni aplicar a solicitudes hasta que nuestro equipo de revisión apruebe su perfil. <br>
								Por favor, asegúrese de llenar cuidadosamente los datos requeridos para su perfil, subir los documentos necesarios y leer cuidadosamente los términos y condiciones (enlace al final de esta página).<br>
								El proceso de revisión suele tomar un máximo de 48 horas.
							</div>
						@endif
						
						<div class="profile-login-bg">
							<h2><span><i class="fa fa-user"></i></span> Información <span>Personal</span></h2>
							
							

							<div class="row p_b30">
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('rut') ? 'has-error' : '' }}">
										<label for="name">RUT/DNI/PASAPORTE</label>
										<input class="form-control" id="rut" name="rut" value="{{ $user->rut }}" type="text" placeholder="Ingrese su Identificación" required>
										{!! $errors->first('rut', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
										<label for="name">Fecha de nacimiento</label>
										<input class="form-control" id="fecha_nac" name="birthday" value="{{ $user->profile? $user->profile->birthday : '' }}" type="date" placeholder="Ingrese su fecha de naimiento" required>
										{!! $errors->first('birthday', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('f_name') ? 'has-error' : '' }}">
										<label for="name">Nombre</label>
										<input class="form-control" id="name" name="f_name" value="{{ $user->profile? $user->profile->f_name : '' }}" type="text" placeholder="Ingrese su nombre" required>
										{!! $errors->first('f_name', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('l_name') ? 'has-error' : '' }}">
										<label for="name">Apellido</label>
										<input class="form-control" id="apellido" name="l_name" value="{{ $user->profile? $user->profile->l_name : '' }}" type="text" placeholder="Ingrese su apellido" required>
										{!! $errors->first('l_name', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label for="email">Email</label>
										<input class="form-control" id="email" name="email" value="{{ $user->email }}" type="email" placeholder="Ingrese su email" required>
										{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
										<label for="mobile">Fono</label>
										<input class="form-control" id="mobile" name="phone" value="{{ $user->profile? $user->profile->phone : '' }}" type="text" placeholder="Ingrese su teléfono" required>
										{!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
										<label for="gender">Sexo</label>
										<select class="form-control" id="gender" name="gender" required>
											<option disabled="disabled" selected="selected">Seleccione su sexo</option>
											<option value="male" {{ $user->profile && $user->profile->gender == 'male' ? 'selected':'' }}>Masculino</option>
											<option value="female" {{ $user->profile && $user->profile->gender == 'female' ? 'selected':'' }}>Femenino</option>
										</select>
										{!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="phone">Nacionalidad</label>
										<select class="form-control" id="nationality" name="nationality" >
											<option disabled {{ $user->profile && $user->profile->nationality == null ? 'selected':'' }}>Seleccione su país</option>
											<option value="Chile" {{ $user->profile && $user->profile->nationality == 'Chile' ? 'selected':'' }}>Chile</option>
											<option value="Argentina" {{ $user->profile && $user->profile->nationality == 'Argentina' ? 'selected':'' }}>Argentina</option>
										</select>
										
									</div>
								</div>
							</div>

							<h2><span><i class="fa fa-map-marker"></i></span> Dirección</h2>
							
							<div class="row p_b30">
								<div class="form-group col-md-6">
									<label for="state">Comuna</label>
									<input list="communities" class="form-control" id="state" name="comunity" value="{{ $user->profile? $user->profile->comunity : '' }}" type="text">
									@component('partials.community-datalist')
									@endcomponent
								</div>
								<div class="form-group col-md-6">
									<label for="city">Ciudad</label>
									<input list="cities" class="form-control" id="city" name="city" value="{{ $user->profile? $user->profile->city : '' }}" type="text">
									@component('partials.city-datalist')
									@endcomponent
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="street">Calle</label>
										<input class="form-control" id="street" name="street" value="{{ $user->profile? $user->profile->street : '' }}" type="text">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="block">Dpto/Block</label>
										<input class="form-control" id="block" name="block" value="{{ $user->profile? $user->profile->block : '' }}" type="text">
									</div>
								</div>
							</div>

							<h2><span><i class="fa fa-map-marker"></i></span> Sobre <span>Mi</span></h2>
							
							<div class="row p_b30">
								<div class="form-group col-md-12">
									<label for="about-me">Algunas palabras sobre ti...</label>
									<div class="form-group">
										<textarea class="form-control" id="about-me" rows="3" name="about_me">{{ $user->profile? $user->profile->about_me : '' }}</textarea>
									</div>
								</div>
							</div>
							
							<h2><span><i class="fa fa-crop"></i></span> Documentos</h2>
							
							<div class="well">
								<p>Como requerimiento para poder realizar actividades regulares en Cinco Estrellas es necesario suministrar los siguientes documentos:</p>
								<ul style="list-style: initial; margin: 10px 0 10px 30px;">
									<li>Imagen o PDF de su documentos de identidad, legible. (Rquerido)</li>
									<li>Imagen o PDF de certificado de buena conducta. (Rquerido)</li>
									<li>Imagen o PDF de certificados que validen tus habilidades. (Opcional)</li>
									<li>Imagen o PDF de cualquier otro documento que consideres pertinente. (Opcional)</li>
								</ul>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="listing-title-area">
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<button type="button" onclick="location.href='{{ route('worker.documents') }}'">Ver documentos</button>
												</div>
											</div>
											<div class="col-md-12">
												
												Tabla con los documentos subidos...
												
											</div>
										</div>

										<div class="row m_t40">
											<div class="col-md-7 col-md-7 col-sm-12">
												<div class="form-group">
													<p>Al hacer click acepta los <a href="#">términos y condiciones de CincoEstrellas</a>
													</p>
												</div>
											</div>

											<div class="col-md-5 col-sm-5 col-xs-12">
												<div class="form-group">
													<button type="submit">Guardar y Aceptar</button>
												</div>
											</div>
										</div>
									</div>
								</div> {{-- col-md-12 --}}
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

	</section>
	<!-- Popular Listing -->
@endsection

@section('scripts')

	<script type="text/javascript">
		
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
		
		/**
		 * 
		 */
		function selectImage(input) {
			console.log('Image container clicked');
			document.getElementById(input).click();
		}
		
	</script>
	
	<script>
		(function() {
			document.getElementById('profile_menu').classList.add('active');
			document.getElementById('worker-menu').classList.add('active');
		})()
	</script>

@endsection

