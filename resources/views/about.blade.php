@extends('layouts.site')

@section('title', 'Nosotros')

@section('css')
@endsection

@section('content')
	
	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>¿Cómo Funciona?</h2>
						<p><a href="index.html">Inicio</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Cómo Funciona</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- About Us -->
	<section id="about-us-1" class="p_b70 p_t70">
		<div class="container">
			<div class="row p_t30 p_b30">
				<div class="col-xs-8">
					<div class="heading">
						<h2>Un cliente <span>Solicita</span> un servicio</h2>
					</div>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-8">
					<div class="about-us-detail">
						<p><i class="fa fa-check"></i> Los clientes utilizan Cinco Estrellas para buscar profesionales de la localidad que les ayuden a llevar a cabo sus proyectos personales ,ya sea por distintos motivos.</p>
						<p><i class="fa fa-check"></i> Aportando la información más detallada posible sobre el servicio que necesitan, para que puedan postular los expertos más apropiados profesionalmente</p>
						<p><i class="fa fa-check"></i> Cinco Estrellas revisará las solicitudes del cliente para asegurar que cumple las condiciones del servicio.</p>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="about-icon">
						<i class="fa fa-calendar-check-o fa-6x"></i>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="about-us-2">
		<div class="container">
			<div class="row p_t30 p_b30">
				<div class="col-xs-8">
					<div class="heading">
						<h2>Si te interesa y estás apto, <span>¡Postulas!</span></h2>
					</div>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-8">
					<div class="about-us-detail">
						<p><i class="fa fa-check"></i> Cinco estrellas envía esta solicitud por correo electrónico y/o  mensaje de texto (SMS) a todos los Profesionales que están aprobados y cumplen con el servicio solicitado.</p>
						<p><i class="fa fa-check"></i> Tú decides si deseas enviar tu perfil al Cliente.</p>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="about-icon">
						<i class="fa fa-check-square-o fa-6x"></i>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="about-us-3">
		<div class="container">
			<div class="row p_t30 p_b30">
				<div class="col-xs-8">
					<div class="heading">
						<h2><span>Postula</span> al Trabajo</h2>
					</div>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-8">
					<div class="about-us-detail">
						<p><i class="fa fa-check"></i> Para Postular el Equipo de Cinco Estrellas Verificará tú información aportada en el Registro + Otra Documentación que puedes subir en tu Perfil (Sólo la Primera Vez).</p>
						<p><i class="fa fa-check"></i> Junto tu Postulación el Cliente Podrá ver tu Actividad en la Página, Revisar tus Valoraciones, tarifa y Ver tu Información Profesional.</p>
						<p><i class="fa fa-check"></i> Cuándo seas Seleccionado para Brindar tu prestación de servicios se te notificará vía SMS y/o E-mail con la información correspondiente.</p>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="about-icon">
						<i class="fa fa-handshake-o fa-6x"></i>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="about-us-3">
		<div class="container">
			<div class="row p_t30 p_b30">
				<div class="col-xs-8">
					<div class="heading">
						<h2>Trabajo <span>Finalizado</span></h2>
					</div>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-8">
					<div class="about-us-detail">
						<p><i class="fa fa-check"></i> Cuándo hayas terminado tu trabajo ingresa a la plataforma para confirmar la correcta realización del servicio , nosotros con hasta 7 días hábiles haremos el pago de tu Realización de Servicios o Visitas de Factibilidad.</p>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="about-icon">
						<i class="fa fa-thumbs-o-up fa-6x"></i>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="about-us-3">
		<div class="container">
			<div class="row p_t30 p_b30">
				<div class="col-xs-8">
					<div class="heading">
						<h2>Da lo mejor de tí</h2>
					</div>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-8">
					<div class="about-us-detail">
						<p><i class="fa fa-check"></i> Mientras mejor sea el servicio brindado más aumentan tus posibilidades de ser Re-Contratado , tus clientes te brindarán la mejor calificación , tendrás un respaldo de tus trabajos realizados y eso te hará marcar la diferencia  de los demás.</p>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="about-icon">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="about-bg-img" style="background-image: url({{ $content->cta1_image }});">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="about-us-detail-img">
						<h2>{{ $content->cta1_title }}</h2>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div id="services-section-two" class="p_b70 p_t70">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="service-two-detail">
						<h3><i class="fa fa-tablet"></i> REQUERIMIENTOS</h3>
						<p>Ingresa el detalle de tu requerimiento, cantidad de personas, horas, servicio, periodo de tiempo, etc.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="service-two-detail">
						<h3><i class="fa fa-desktop"></i>POSTULANTES</h3>
						<p>Serás notificado de los postulantes que tienes interesados en tu requermiento, selecciona y contrata.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="service-two-detail">
						<h3><i class="fa fa-picture-o"></i>PAGO EN LINEA</h3>
						<p>Contrata y Paga en linea, nosotros nos encargamos de lo demás.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- 

  +"cta1_title": "Encuentra facilmente un servicio y quien lo haga!"
  +"cta2_title": "También puedes ser contratado."
  +"cta2_text": "Registrate, recibe ofertas de trabajo, postula, y listo..."
  +"cta2_btn_text": "Registrarse"
  +"cta2_btn_link": "/worker/register"
  +"cta1_image": "images/1578669490a.jpg"
  +"cta2_image": "images/bg.jpg"

--}}
	<section id="about-bg-img2" style="background-image: url({{ $content->cta2_image }});">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="about-us-detail-img">
						<h2>{{ $content->cta2_title }}</h2>
						<p>{{ $content->cta2_text }}</p>
						<a href="{{ route('worker.register') }}">Registrarse</a>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About Us -->
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('how-it-works-menu').classList.add('active');
		})()
	</script>
@endsection


