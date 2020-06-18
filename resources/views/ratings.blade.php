@extends('layouts.site')

@section('title', 'Mis pagos')

@section('css')
@endsection

@section('content')

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
	
	<section id="profile" class="p_b70 p_t70 bg_lightgry">
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
				<section id="popular-listing" class="p_b70 p_t70">
					<div class="container">
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="messages">
										
										
										@foreach ($client_ratings as $rating)
											<div class="popular-listing-box">
												<div class="row">
													<div class="col-md-3 col-sm-5 col-xs-12">
														<div class="popular-listing-img">
															<figure class="effect-ming"> 
																<img src="{{ asset($rating->worker->profile->image_path) }}" 
																     alt="{{ asset($rating->worker->profile->image_path) }}" 
																     title="{{ $rating->worker->profile->full_name() }}" 
																     style="
																         width: 100%;
																         height: all;
																         object-fit: cover;
																     ">
															</figure>
														</div>
													</div>
													<div class="col-md-9 col-sm-7 col-xs-12">
														<div class="popular-listing-detail">
															<h3><a href="#">{{ $rating->worker->profile->full_name() }}</a></h3>
															<p>
																Te calificó con: <span class="rateit" data-rateit-value="{{ $rating->stars }}" data-rateit-ispreset="true" data-rateit-readonly="true"></span><br><br>
																<b>{{ $rating->comment }}</b>
															</p>
														</div>
														<div class="popular-listing-add"> 
															<span>
																<i class="fa fa-map-marker" aria-hidden="true"></i>
																{{ $rating->worker->profile->comunity }}
															</span> 
															@if ($rating->service_order->client_rating)
																<span class="rateit pull-right" 
																      data-rateit-value="{{ $rating->user->ratings->avg('stars') }}"
																      data-rateit-ispreset="true" 
																      data-rateit-readonly="true"></span> 
															@else
																<a class="btn btn-primary pull-right" href="{{ route('user.rating.create', $rating->service_order) }}" title="Calificar">Calificar</a>
															@endif
														</div>
													</div>
												</div>
											</div>
										@endforeach
										
									</div>
								</div>
								
								{{-- Here goes the paginator links --}}
								{{ $client_ratings->links() }}
								
							</div>
						</div>
					</div>
				</section>
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