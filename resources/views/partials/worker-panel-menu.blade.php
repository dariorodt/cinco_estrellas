<div class="profile-list">
	<ul>
		<li id="profile_menu">
			<a href="{{ Auth::user()->profile? route('worker.dashboard') : '' }}">
				<i class="fa fa-user-o" aria-hidden="true"></i> Mi Perfil
				@if (!Auth::user()->profile || Auth::user()->profile->state == 'inactive')
					<span class="dashboard_menu_badge">Inactivo</span>
				@endif
			</a>
		</li>
		<li id="services_menu">
			<a href="{{ Auth::user()->profile? route('worker.services') : '' }}">
				<i class="fa fa-sliders" aria-hidden="true"></i> Mis Servicios
			</a>
		</li>
		<li id="calendar_menu">
			<a href="{{ Auth::user()->profile? route('worker.calendar') : '' }}">
				<i class="fa fa-calendar" aria-hidden="true"></i> Mi Calendario
			</a>
		</li>
		<li id="payments_menu">
			<a href="{{ Auth::user()->profile? route('worker.payments') : '' }}">
				<i class="fa fa-money" aria-hidden="true"></i> Mis Pagos
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenHired')->count())
				<span class="dashboard_menu_badge">
					{{ Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenHired')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li id="works_menu">
			<a href="{{ Auth::user()->profile? route('worker.jobs') : '' }}">
				<i class="fa fa-plus-square" aria-hidden="true"></i> Trabajos 
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\JobPosted')->count())
				<span id="jobs_badge" class="dashboard_menu_badge">
					{{ Auth::user()->unreadNotifications->where('type', 'App\Notifications\JobPosted')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li id="messages_menu">
			<a href="{{ Auth::user()->profile? route('worker.messages') : '' }}">
				<i class="fa fa-commenting" aria-hidden="true"></i> Mensajes 
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\MessageReceived')->count())
				<span class="dashboard_menu_badge">
					{{ Auth::user()->unreadNotifications->where('type', 'App\Notifications\MessageReceived')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li id="ratings_menu">
			<a href="{{ Auth::user()->profile? route('worker.ratings') : '' }}">
				<i class="fa fa-star" aria-hidden="true"></i> Calificaciones
				@if (Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenRated')->count())
				<span class="dashboard_menu_badge">
					{{ Auth::user()->unreadNotifications->where('type', 'App\Notifications\HaveBeenRated')->count() }}
				</span>
				@endif
			</a>
		</li>
		<li>
			{{-- DANGER! Don't define any link in this anchor  --}}
			<a href="#" onclick="logout('worker-logout')"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión</a>
		</li>
	</ul>
</div>