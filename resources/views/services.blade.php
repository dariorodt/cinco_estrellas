@extends('layouts.site')

@section('title', 'Nuestros Servicios')

@section('css')
@endsection

@section('content')
	
	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Nuestros Servicios</h2>
						<p>
							<a href="index.html">Inicio</a> 
							<i class="fa fa-angle-double-right" aria-hidden="true"></i> Nuestros Servicios
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Inner Banner -->
	
	<section id="directory-category" class="p_b70 p_t70">
		<div class="container">
			<div class="row">
				<div class="col-md-12 directory-category-heading">
					<h2>Actualmente <span>Ofrecemos</span></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					
					@foreach ($services as $service)
						<div class="directory-category-box text-center" style="height: 250px">
							<span>
								<i class="fa {{ $service->fa_icon }}" aria-hidden="true"></i>
							</span>
							<a href="{{ route('home') }}">
								<h3>{{ $service->name }}</h3>
							</a>
							<p>Trabajadores: {{ $service->workers->count() }}</p>
							<p>Solicitudes: {{ \App\ServiceOrder::where('service_id', $service->id)->count() }}</p>
						</div>
					@endforeach
					
				</div>
			</div>
		</div>
	</section>
	
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('services-menu').classList.add('active');
		})()
	</script>
@endsection

