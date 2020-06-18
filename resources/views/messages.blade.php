@extends('layouts.site')

@section('title', 'Mis mensajes')

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
					<!-- Popular Listing -->
				<!-- Blog -->
				<section id="blog" class="p_b70 p_t70 bg_lightgry">
					<div class="container">

						<div class="row">

							<div class="col-md-9 col-sm-9 col-xs-12">

								<div class="row">

									<div class="col-md-12 heading">
										<h2>Mensajes</h2>
									</div>
									@foreach ($orders as $order)
										@if ($order->messages->count())
											<div class="col-md-12">
												<div class="blog-detail-review">
													<div class="row">

														<div class="col-md-2 col-sm-2 col-xs-12">
															<div class="blog-detail-img">
																<img src="{{ asset($order->worker->profile->image_path) }}" alt="image">
															</div>
														</div>

														<div class="col-md-10 col-sm-10 col-xs-12">
															<div class="blog-detail-review-detail">
																<h4>Servicio de {{ $order->service->name }} <small>({{ $order->worker->profile->full_name() }})</small></h4>
																<span>{{ $order->created_at->isoFormat('LLL') }}</span>
																<p>{{ $order->messages->last()->body }}</p>
																<a href="{{ route('user.message.chat', $order) }}" class="reply float_right btn button2">Responder</a>
															</div>
														</div>

													</div>
												</div>
											</div>
										@endif
									@endforeach
									
								</div>
							</div>

						</div>

					</div>
				</section>
				<!-- Blog -->
				<!-- Popular Listing -->
			</div>
		</div>
	</section>
@endsection

@section('scripts')

	<script>
		(function() {
			document.getElementById('messages_menu').classList.add('active');
		})()
	</script>

@endsection

