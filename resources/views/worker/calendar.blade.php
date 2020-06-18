@extends('layouts.site')

@section('title', 'Mi Calendario')

@section('css')
	<link href="{{ asset('js/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('js/full-calendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
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
				<!-- Popular Listing -->
				<!-- Blog -->
				<section id="blog" class="p_b70 p_t70 bg_lightgry">
					<div class="container">

						<div class="row">

							<div class="col-md-9 col-sm-9 col-xs-12">

								<div class="row">

									<div class="col-md-12 heading">
										<h2>Mi Calendario</h2>
									</div>
									<div class="col-md-12">
										<div class="white-box">
										 <div id='calendar'></div>
										</div>
								  </div>
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
	<!-- Popular Listing -->
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/moment/moment.js') }}"></script>
	<script src="{{ asset('js/full-calendar/fullcalendar.js') }}"></script>
	
	<script>
		$(document).ready(function() {
				
			$('#external-events .fc-event').each(function() {

				// store data so the calendar knows to render an event upon drop
				$(this).data('event', {
					title: $.trim($(this).text()), // use the element's text as the event title
					stick: true // maintain when user navigates (see docs on the renderEvent method)
				});

				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex: 999,
					revert: true,      // will cause the event to go back to its
					revertDuration: 0  //  original position after the drag
				});

			});
			
			/* initialize the calendar
			-----------------------------------------------------------------*/
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				defaultDate: '2019-10-27',
				editable: true,
				droppable: true,
				eventLimit: true, 
				events: '{{ route('worker.calendar.calendar', Auth::user()) }}'
			});	
		});
		
		// Para agregar eventos al calendario se puede usar el comando «renderEvent» de FullCalendar
		// Este se utiliza de la siguiente manera:
		// Primero generamos un objeto JSON con la misma estructura de datos que nuestros eventos:
		
		// var evento = {
		// 	title: "Evento nuevo", // Obligatorio para Full Calendar
		// 	start: "2019-05-15 00:00:00", // Obligatorio para Full Calendar
		// 	end: "2019-05-16 23:59:59", // Obligatorio para Full Calendar
		// 	color: "#77A1FF", // Obligatorio para Full Calendar
		// 	textColor: "#DFDFDF", // Obligatorio para Full Calendar
		// 	description: "Costom data field",
		// 	address: "Custom data field"
		// }
		
		// Luego integramos eo objeto «evento» al calendario mediante el comendo «renderEvent»
		
		// $('#calendar').fullCalendar('renderEvent', evento);
		
	</script>
	
	<script>
		(function() {
			document.getElementById('calendar_menu').classList.add('active');
			document.getElementById('worker-menu').classList.add('active');
		})()
	</script>
@endsection

