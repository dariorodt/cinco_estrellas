@extends('layouts.site')

@section('title', 'Contacto')

@section('css')
@endsection

@section('content')
	
	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Ayuda</h2>
						<p><a href="/">Inicio</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Ayuda</p>
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
				<div class="col-xs-12">
					<div class="document">{!! $contact_help_text !!}</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('contact-menu').classList.add('active');
		})()
	</script>
@endsection