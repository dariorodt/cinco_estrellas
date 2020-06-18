@extends('layouts.site')

@section('title', 'Conversación')

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
							@if ($worker->profile)
								<img src="{{ asset($worker->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					@component('partials.worker-panel-menu')
					@endcomponent

				</div>
				
				<div class="col-md-9 col-sm-9 col-xs-12 bg_white">
					<div class="row">
						@if ($errors)
							@foreach ($errors->all() as $message)
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissible" role="alert" style="margin: 5px;">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										{{ $message }}
									</div>
								</div>	
							@endforeach
						@endif
						<div class="col-md-12 heading m_t30">
							<h2><small>Solicitud de servicio de</small> {{ $order->service->name }}</h2>
							<p><b>Cliente:</b> {{ $order->client->profile->full_name() }}</p>
						</div>
						
						<div class="col-md-12">
							<div class="chat-frame">
								
								@foreach ($order->messages as $message)
									<div class="msg-box {{ $message->sender == 'client' ? 'msg-box-lf' : 'msg-box-rg' }}">
										@if ($message->sender == 'worker')
											<div class="msg-baloon msg-baloon-rg">
												<small><em> {{ $message->created_at }} </em></small><br>
												{{ $message->body }}
											</div>
										@endif
										<div class="img-box">
											@if ($message->sender == 'client')
												<img src="{{ asset($order->client->profile->image_path) }}" class="user-img">
											@else
												<img src="{{ asset($worker->profile->image_path) }}" class="user-img">
											@endif
										</div>
										@if ($message->sender == 'client')
											<div class="msg-baloon msg-baloon-lf">
												<small><em> {{ $message->created_at }} </em></small><br>
												{{ $message->body }}
											</div>
										@endif
									</div>
								@endforeach
								
							</div>
						</div>
						
						<div class="col-md-12 m_t10 m_b30">
							<form action="{{ route('worker.message.send', $order) }}" method="POST">
								@csrf
								<input type="hidden" name="user_id" value="{{ $order->user_id }}">
								<input type="hidden" name="worker_id" value="{{ $order->worker_id }}">
								<input type="hidden" name="sender" value="worker">
								<div class="input-group input-group-lg">
									<input type="text" name="body" class="form-control" placeholder="Escriba aquí su mensaje..." autofocus>
									<span class="input-group-btn">
										<button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
									</span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')

	<script>
		(function() {
			document.getElementById('messages_menu').classList.add('active');
			document.getElementById('worker-menu').classList.add('active');
		})()
	</script>

@endsection
