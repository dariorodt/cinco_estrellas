@extends('layouts.site')

@section('title', 'Misión y Visión')

@section('css')
@endsection

@section('content')
	
	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Misión y Visión</h2>
						<p><a href="{{ route('welcome') }}">Inicio</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Misión y visión</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Mission -->
	<section id="mission" class="p_t70 p_b70">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="document">{!! $mission_text !!}</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Vission -->
	<section id="vission" class="p_t70 p_b70">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="document">{!! $vission_text !!}</div>
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


