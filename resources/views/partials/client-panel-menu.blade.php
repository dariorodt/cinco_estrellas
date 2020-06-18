<div class="profile-list">
	<ul>
		<li id="profile_menu">
			<a href="{{ route('home') }}">
				<i class="fa fa-user-o" aria-hidden="true"></i> Mi Perfil
				@if (!Auth::user()->profile || Auth::user()->profile->status == 'inactive')
					<span class="dashboard_menu_badge">Inactivo</span>
				@endif
			</a>
		</li>
		<li id="services_menu">
			<a href="{{ Auth::user()->profile? route('user.orders') : '' }}">
				<i class="fa fa-sliders" aria-hidden="true"></i> Mis Solicitudes
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\ApplicationReceived')->count())
				<span class="dashboard_menu_badge">
					{{ Auth::user()->notifications->where('type', 'App\Notifications\ApplicationReceived')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li id="calendar_menu">
			<a href="{{ Auth::user()->profile? route('user.calendar') : '' }}"><i class="fa fa-calendar" aria-hidden="true"></i> Mi Calendario</a>
		</li>
		<li id="payments_menu">
			<a href="{{ Auth::user()->profile? route('user.payments') : '' }}"><i class="fa fa-money" aria-hidden="true"></i> Mis Pagos</a>
		</li>
		<li id="messages_menu">
			<a href="{{ Auth::user()->profile? route('user.messages') : '' }}">
				<i class="fa fa-commenting" aria-hidden="true"></i> Mensajes 
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\MessageReceived')->count())
				<span class="dashboard_menu_badge">
					{{ Auth::user()->notifications->where('type', 'App\Notifications\MessageReceived')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li id="ratings_menu">
			<a href="{{ Auth::user()->profile? route('user.ratings') : '' }}">
				<i class="fa fa-star" aria-hidden="true"></i> Calificaciones
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenRated')->count())
				<span class="dashboard_menu_badge">
					{{ Auth::user()->notifications->where('type', 'App\Notifications\HaveBeenRated')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li>
			{{-- DANGER! Don't define any link in this anchor  --}}
			<a href="#" onclick="logout('client-logout')"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión</a>
		</li>
	</ul>
</div>