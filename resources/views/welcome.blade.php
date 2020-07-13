@extends('layouts.site')

@section('title', 'Bienvenidos')

@section('css')
@endsection

@section('content')
	{{-- Banner --}}
	{{-- <section id="banner-2" class="animated-bg banner-2-bg"> --}}
	<section id="banner-2" class="banner-2-bg" style="background-image: url({{ $content->cover_image }});">

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="banner-text">
						<h2 style="text-shadow: 2px 2px rgba(0,0,0,0.5);">{!! $content->cover_title !!}</h2>
						<p>{!! $content->cover_message !!}</p>
						<a href="{{ url($content->cover_link) }}">{{ $content->cover_link_text }}</a>
					</div>
				</div>

				<div class="col-md-6 col-sm-12 col-xs-12"></div>
			</div>
		</div>

	</section>
	{{-- Banner --}}

	{{-- Directory Category --}}
	<section id="directory-category" class="p_b70 p_t70">
		<div class="container">
			<div class="row">
				<div class="col-md-12 directory-category-heading">
					<h2>Algunos <span>Servicios</span></h2>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div id="directory-category-slider" class="owl-carousel owl-theme">
						@foreach ($services as $service)
							<div class="item">
								<div class="directory-category-box text-center resturent"> 
									<span>
										@if ($service->icon)
											<img class="img-circle" src="{{ $service->icon }}" alt="">
										@else
											<i class="fa {{ $service->fa_icon }}" aria-hidden="true"></i>
										@endif
									</span>
									<a href="{{ route('user.order.create') }}">
										<h3>{{ $service->name }}</h3>
									</a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- Directory Category --}}

	{{-- Popular Listing --}}
	<section id="popular-listing" class="p_t70 over-hide-bottom"></section>
	{{-- Popular Listing --}}

	{{-- Most visited places --}}
	<section id="post-visited-places">

		<div class="container over-hide">

			<div class="row">
				<div class="col-md-12 heading text-center">
					<h2>Trabajadores del <span>Mes</span></h2>
					<p>Algunos de nuestros mejores trabajadores dentro de la gran red Cinco Estrellas</p>
				</div>
			</div>

			<div class="row">
				<div id="places-slider" class="owl-carousel owl-theme">
					
					@foreach ($higer_ratings as $rating)
						
						<div class="item">
							<div class="popular-listing-box">
								<div class="popular-listing-img">
									<figure class="effect-ming">
										<img src="{{ $rating->worker->profile->image_path }}" alt="image" width="370" height="190" style="object-fit: cover;">
									</figure>
								</div>

								<div class="popular-listing-detail">
									<h3>
										<a href="listing-details.html">
											{{ $rating->worker->profile->f_name }} {{ $rating->worker->profile->l_name }}
										</a>
									</h3>
									<span>Servicio: <a href="restaurant.html">Limpieza Hogar</a></span>
								</div>

								<ul class="place-listing-add">
									<li>(31 votos) </li>
									<li><img src="images/stars.png" alt="image">
									</li>
									<li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
									</li>
								</ul>

							</div>
						</div>
						
					@endforeach

				</div>
			</div>
		</div>
	</section>
	{{-- Most visited places --}}

	{{-- Counter Section --}}
	<div id="counter-section">
		<div class="container">

			<div class="row number-counters text-center">

				<div class="col-md-3 col-sm-6 col-xs-12">
					{{-- first count item --}}
					<div class="counters-item">
						<i class="fa fa-file" aria-hidden="true"></i>
						{{-- Set Your Number here. i,e. data-to="56" --}}
						<strong data-to="520">0</strong>
						<p>Ofertas</p>
						<div class="border-inner"></div>
					</div>

				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					{{-- first count item --}}
					<div class="counters-item">
						<i class="fa fa-users" aria-hidden="true"></i>
						{{-- Set Your Number here. i,e. data-to="56" --}}
						<strong data-to="5620">0</strong>
						<p>Usuarios</p>
						<div class="border-inner"></div>
					</div>

				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					{{-- first count item --}}
					<div class="counters-item">
						<i class="fa fa-th" aria-hidden="true"></i>
						{{-- Set Your Number here. i,e. data-to="56" --}}
						<strong data-to="180">0</strong>
						<p>Servicios</p>
						<div class="border-inner"></div>
					</div>

				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					{{-- first count item --}}
					<div class="counters-item">
						<i class="fa fa-map-pin" aria-hidden="true"></i>
						{{-- Set Your Number here. i,e. data-to="56" --}}
						<strong data-to="220">0</strong>
						<p>Ciudades</p>
						<div class="border-inner"></div>
					</div>

				</div>

			</div>

		</div>
	</div>
	{{-- Counter Section --}}


	{{-- User --}}
	@if ($workers->count() > 30)
	<section id="our-user" class="p_t70 p_b70">
		<div class="container">

			<div class="row">

				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="row">
						<div class="col-md-12 heading">
							<h2>Nuestros <span>{{ $workers->count() }}</span> Trabajadores</h2>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12 user-btn">
					<a href="{{ route('worker.register') }}">Trabajar</a>
				</div>

			</div>
			
			
			
				<div class="row">
					<div class="col-md-12 text-center">
						<div id="ri-grid" class="ri-grid ri-grid-size-1 ri-shadow">
							<ul>
								@foreach ($workers as $worker)
									<li>
										<a href="#">
											<img src="{{ asset($worker->profile->image_path) }}" 
											     alt="worker image" 
											     title="{{ $worker->profile->full_name() }}" />
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
		</div>
	</section>
	@endif
	{{-- Useer --}}
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('start-menu').classList.add('active');
		})()
	</script>
@endsection
