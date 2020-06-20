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

				<form id="profile_form" action="{{ route('user.update_profile') }}" 
				      method="POST" enctype="multipart/form-data">
					@csrf
				
					{{-- Aside menu section --}}
					<div class="col-md-3 col-sm-3 col-xs-12">

						<div class="profile-leftbar">
							
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

						@component('partials.client-panel-menu')
						@endcomponent

					</div>
					{{-- Aside menu section --}}
					
					<div class="col-md-9 col-sm-9 col-xs-12">
						@if (!Auth::user()->profile || Auth::user()->profile->status == 'inactive')
							<div class="alert alert-warning" role="alert">
								<h4><i class="fa fa-warning"></i> ¡Advertencia!</h4>
								Su estado actual es «INACTIVO», por lo tanto, usted no podrá solicitar servicios ni contratar trabajadores hasta que nuestro equipo de revisión apruebe su perfil. <br>
								Por favor, asegúrese de llenar cuidadosamente los datos requeridos para su perfil, subir los documentos necesarios y leer cuidadosamente los términos y condiciones (enlace al final de esta página).<br>
								El proceso de revisión suele tomar un máximo de 48 horas.
							</div>
						@endif
						
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
										<input class="form-control" id="mobile" name="phone" value="{{ $user->phone_number }}" type="text" placeholder="Ingrese su teléfono" required>
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
									<input list="comunities" class="form-control" id="state" name="comunity" value="{{ $user->profile? $user->profile->comunity : '' }}" type="text">
									<datalist id="comunities">
										<option value="Iquique">
										<option value="Alto Hospicio">
										<option value="Pozo Almonte">
										<option value="Camiña">
										<option value="Colchane">
										<option value="Huara">
										<option value="Pica">
										<option value="Antofagasta">
										<option value="Mejillones">
										<option value="Sierra Gorda">
										<option value="Taltal">
										<option value="Calama">
										<option value="Ollague">
										<option value="San Pedro de Atacama">
										<option value="Tocopilla">
										<option value="María Elena">
										<option value="Copiapó">
										<option value="Caldera">
										<option value="Tierra Amarilla">
										<option value="Chañaral">
										<option value="Diego de Almagro">
										<option value="Vallenar">
										<option value="Alto del Carmen">
										<option value="Freirina">
										<option value="Huasco">
										<option value="La Serena">
										<option value="Coquimbo">
										<option value="Andacollo">
										<option value="La Higuera">
										<option value="Paihuano">
										<option value="Vicuña">
										<option value="Illapel">
										<option value="Canela">
										<option value="Los Vilos">
										<option value="Salamanca">
										<option value="Ovalle">
										<option value="Combarbalá">
										<option value="Monte Patria">
										<option value="Punitaqui">
										<option value="Río Hurtado">
										<option value="Valparaíso">
										<option value="Casablanca">
										<option value="Concón">
										<option value="Juan Fernández">
										<option value="Puchuncaví">
										<option value="Quilpué">
										<option value="Quintero">
										<option value="Villa Alemana">
										<option value="Viña del Mar">
										<option value="Isla de Pascua">
										<option value="Los Andes">
										<option value="Calle Larga">
										<option value="Rinconada">
										<option value="San Esteban">
										<option value="La Ligua">
										<option value="Cabildo">
										<option value="Papudo">
										<option value="Petorca">
										<option value="Zapallar">
										<option value="Quillota">
										<option value="Calera">
										<option value="Hijuelas">
										<option value="La Cruz">
										<option value="Limache">
										<option value="Nogales">
										<option value="Olmué">
										<option value="San Antonio">
										<option value="Algarrobo">
										<option value="Cartagena">
										<option value="El Quisco">
										<option value="El Tabo">
										<option value="Santo Domingo">
										<option value="San Felipe">
										<option value="Catemu">
										<option value="Llay Llay">
										<option value="Panquehue">
										<option value="Putaendo">
										<option value="Santa María">
										<option value="Rancagua">
										<option value="Codegua">
										<option value="Coinco">
										<option value="Coltauco">
										<option value="Doñihue">
										<option value="Graneros">
										<option value="Las Cabras">
										<option value="Machalí">
										<option value="Malloa">
										<option value="Mostazal">
										<option value="Olivar">
										<option value="Peumo">
										<option value="Pichidegua">
										<option value="Quinta de Tilcoco">
										<option value="Rengo">
										<option value="Requinoa">
										<option value="San Vicente">
										<option value="Pichilemu">
										<option value="La Estrella">
										<option value="Litueche">
										<option value="Marchihue">
										<option value="Navidad">
										<option value="Paredones">
										<option value="San Fernando">
										<option value="Chépica">
										<option value="Chimbarongo">
										<option value="Lolol">
										<option value="Nancagua">
										<option value="Palmilla">
										<option value="Peralillo">
										<option value="Placilla">
										<option value="Pumanque">
										<option value="Santa Cruz">
										<option value="Talca">
										<option value="Constitución">
										<option value="Curepto">
										<option value="Empedrado">
										<option value="Maule">
										<option value="Pelarco">
										<option value="Pencahue">
										<option value="Río Claro">
										<option value="San Clemente">
										<option value="San Rafael">
										<option value="Cauquenes">
										<option value="Chanco">
										<option value="Pelluhue">
										<option value="Curicó">
										<option value="Hualañé">
										<option value="Licantén">
										<option value="Molina">
										<option value="Rauco">
										<option value="Romeral">
										<option value="Sagrada Familia">
										<option value="Teno">
										<option value="Vichuquén">
										<option value="Linares">
										<option value="Colbún">
										<option value="Longaví">
										<option value="Parral">
										<option value="Retiro">
										<option value="San Javier">
										<option value="Villa Alegre">
										<option value="Yerbas Buenas">
										<option value="Concepción">
										<option value="Coronel">
										<option value="Chiguayante">
										<option value="Florida">
										<option value="Hualqui">
										<option value="Lota">
										<option value="Penco">
										<option value="San Pedro De La Paz">
										<option value="Santa Juana">
										<option value="Talcahuano">
										<option value="Tomé">
										<option value="Hualpén">
										<option value="Lebu">
										<option value="Arauco">
										<option value="Cañete">
										<option value="Contulmo">
										<option value="Curanilahue">
										<option value="Los Alamos">
										<option value="Tirua">
										<option value="Los Angeles">
										<option value="Antuco">
										<option value="Cabrero">
										<option value="Laja">
										<option value="Mulchén">
										<option value="Nacimiento">
										<option value="Negrete">
										<option value="Quilaco">
										<option value="Quilleco">
										<option value="San Rosendo">
										<option value="Santa Bárbara">
										<option value="Tucapel">
										<option value="Yumbel">
										<option value="Alto Biobío">
										<option value="Chillán">
										<option value="Bulnes">
										<option value="Cobquecura">
										<option value="Coelemu">
										<option value="Coihueco">
										<option value="Chillán Viejo">
										<option value="El Carmen">
										<option value="Ninhue">
										<option value="Ñiquén">
										<option value="Pemuco">
										<option value="Pinto">
										<option value="Portezuelo">
										<option value="Quillón">
										<option value="Quirihue">
										<option value="Ranquil">
										<option value="San Carlos">
										<option value="San Fabián">
										<option value="San Ignacio">
										<option value="San Nicolás">
										<option value="Trehuaco">
										<option value="Yungay">
										<option value="Temuco">
										<option value="Carahue">
										<option value="Cunco">
										<option value="Curarrehue">
										<option value="Freire">
										<option value="Galvarino">
										<option value="Gorbea">
										<option value="Lautaro">
										<option value="Loncoche">
										<option value="Melipeuco">
										<option value="Nueva Imperial">
										<option value="Padre Las Casas">
										<option value="Perquenco">
										<option value="Pitrufquén">
										<option value="Pucón">
										<option value="Saavedra">
										<option value="Teodoro Schmidt">
										<option value="Toltén">
										<option value="Vilcún">
										<option value="Villarrica">
										<option value="Cholchol">
										<option value="Angol">
										<option value="Collipulli">
										<option value="Curacautín">
										<option value="Ercilla">
										<option value="Lonquimay">
										<option value="Los Sauces">
										<option value="Lumaco">
										<option value="Purén">
										<option value="Renaico">
										<option value="Traiguén">
										<option value="Victoria">
										<option value="Puerto Montt">
										<option value="Calbuco">
										<option value="Cochamó">
										<option value="Fresia">
										<option value="Frutillar">
										<option value="Los Muermos">
										<option value="Llanquihue">
										<option value="Maullín">
										<option value="Puerto Varas">
										<option value="Castro">
										<option value="Ancud">
										<option value="Chonchi">
										<option value="Curaco de Vélez">
										<option value="Dalcahue">
										<option value="Puqueldón">
										<option value="Queilén">
										<option value="Quellón">
										<option value="Quemchi">
										<option value="Quinchao">
										<option value="Osorno">
										<option value="Puerto Octay">
										<option value="Purranque">
										<option value="Puyehue">
										<option value="Río Negro">
										<option value="San Juan de la Costa">
										<option value="San Pablo">
										<option value="Chaitén">
										<option value="Futaleufú">
										<option value="Hualaihue">
										<option value="Palena">
										<option value="Coihaique">
										<option value="Lago Verde">
										<option value="Aisén">
										<option value="Cisnes">
										<option value="Guaitecas">
										<option value="Cochrane">
										<option value="Ohiggins">
										<option value="Tortel">
										<option value="Chile Chico">
										<option value="Río Ibáñez">
										<option value="Punta Arenas">
										<option value="Laguna Blanca">
										<option value="Río Verde">
										<option value="San Gregorio">
										<option value="Cabo de Hornos">
										<option value="Porvenir">
										<option value="Primavera">
										<option value="Timaukel">
										<option value="Natales">
										<option value="Torres del Paine">
										<option value="Santiago">
										<option value="Cerrillos">
										<option value="Cerro Navia">
										<option value="Conchalí">
										<option value="El Bosque">
										<option value="Estación Central">
										<option value="Huechuraba">
										<option value="Independencia">
										<option value="La Cisterna">
										<option value="La Florida">
										<option value="La Granja">
										<option value="La Pintana">
										<option value="La Reina">
										<option value="Las Condes">
										<option value="Lo Barnechea">
										<option value="Lo Espejo">
										<option value="Lo Prado">
										<option value="Macul">
										<option value="Maipú">
										<option value="Ñuñoa">
										<option value="Pedro Aguirre Cerda">
										<option value="Peñalolén">
										<option value="Providencia">
										<option value="Pudahuel">
										<option value="Quilicura">
										<option value="Quinta Normal">
										<option value="Recoleta">
										<option value="Renca">
										<option value="San Joaquín">
										<option value="San Miguel">
										<option value="San Ramón">
										<option value="Vitacura">
										<option value="Puente Alto">
										<option value="Pirque">
										<option value="San José de Maipo">
										<option value="Colina">
										<option value="Lampa">
										<option value="Til til">
										<option value="San Bernardo">
										<option value="Buin">
										<option value="Calera de Tango">
										<option value="Paine">
										<option value="Melipilla">
										<option value="Alhué">
										<option value="Curacaví">
										<option value="María Pinto">
										<option value="San Pedro">
										<option value="Talagante">
										<option value="El Monte">
										<option value="Isla de Maipo">
										<option value="Padre Hurtado">
										<option value="Peñaflor">
										<option value="Valdivia">
										<option value="Corral">
										<option value="Lanco">
										<option value="Los Lagos">
										<option value="Máfil">
										<option value="Mariquina">
										<option value="Paillaco">
										<option value="Panguipulli">
										<option value="La Unión">
										<option value="Futrono">
										<option value="Lago Ranco">
										<option value="Río Bueno">
										<option value="Arica">
										<option value="Camarones">
										<option value="Putre">
										<option value="General Lagos">
									</datalist>
								</div>
								<div class="form-group col-md-6">
									<label for="city">Ciudad</label>
									<input class="form-control" id="city" name="city" value="{{ $user->profile? $user->profile->city : '' }}" type="text">
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
								<p>Como requerimiento para poder realizar actividades regulares en Cinco Estrellas es necesario suministrar una imagen o PDF legible de tu documento de identidad</p>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="listing-title-area">
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<button type="button" onclick="location.href='{{ route('user.documents') }}'">Ver documentos</button>
												</div>
											</div>
											<div class="col-md-12">
												
												Tabla con los documentos subidos...
												
											</div>
										</div>

										<div class="row m_t40">
											<div class="col-md-7 col-md-7 col-sm-12">
												<div class="form-group">
													<p>Al hacer click acepta los <a href="{{ url('terms-conditions') }}">términos y condiciones de CincoEstrellas</a>
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
		})()
	</script>

@endsection

