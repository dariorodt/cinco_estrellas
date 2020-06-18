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
						<h2>Política de Privacidad</h2>
						<p><a href="index.html">Inicio</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Cómo Funciona</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- About Us -->
	<section id="about-us" class="p_b70 p_t70">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="document">{!! $privacy_policy !!}</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('how-it-works-menu').classList.add('active');
		})()
	</script>
@endsection


