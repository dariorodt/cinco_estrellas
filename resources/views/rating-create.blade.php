@extends('layouts.site')

@section('title', 'Calificar trabajador')

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
							@if (Auth::user()->profile)
								<img src="{{ asset(Auth::user()->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>
					
					@component('partials.client-panel-menu')
					@endcomponent
					
				</div>

				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="details-heading heading">
						<h2 class="p_b20">Calificar a <span>{{ $order->worker->profile->full_name() }}</span></h2>
						
						<form action="{{ route('user.rating.store', $order) }}" method="POST">
							@csrf
							
							<input type="hidden" name="service_order_id" value="{{ $order->id }}">
							<input type="hidden" name="worker_id" value="{{ $order->worker_id }}">
							<input type="hidden" name="sender_id" value="{{ $order->user_id }}">
							<div class="form-group">
								<label for="stars">Indique las estrellas con las que desea calificar al trabajador</label><br>
								<input type="range" name="stars" min="0" max="5" value="0" step="0.5" id="range-input">
								<div class="rateit m_t20" data-rateit-backingfld="#range-input" data-rateit-mode="font" style="font-size: 30px;"></div>
							</div>
							<div class="form-group">
								<label for="comment">Deje un comentario que explique su calificación</label>
								<textarea class="form-control" name="comment" rows="3"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary"><i class="fa fa-upload"></i> Enviar</button>
							</div>
						</form>
						
						{{-- 
						service_order_id
						worker_id
						sender_id
						stars
						coment 
						--}}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	<script>
		(function() {
			document.getElementById('ratings_menu').classList.add('active');
		})()
	</script>
@endsection

