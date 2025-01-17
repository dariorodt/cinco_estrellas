<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
	{{-- Rate It Styles --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('rateit/rateit.css') }}">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
				page. However, you can choose any other skin. Make sure you
				apply the skin class to the body tag so the changes take effect. -->
	{{-- <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-cinco-estrellas.css') }}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
	
	@yield('css')
	
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="{{ url('/') }}" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>5</b>Est</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Cinco</b>Estrellas</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							@if (Auth::user()->profile)
								<!-- The user image in the navbar-->
								<img src="{{ asset(Auth::user()->profile->image) }}" class="user-image" alt="User Image">
							@else
								<!-- The user image in the navbar-->
								<img src="{{ asset('images/super-admin.jpg') }}" class="user-image" alt="User Image">
							@endif
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{ Auth::user()->name }}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								@if (Auth::user()->profile)
									<!-- The user image in the navbar-->
									<img src="{{ asset(Auth::user()->profile->image) }}" class="user-image" alt="User Image">
								@else
									<!-- The user image in the navbar-->
									<img src="{{ asset('images/super-admin.jpg') }}" class="user-image" alt="User Image">
								@endif

								<p>
									{{ Auth::user()->name }} - Web Developer
									<small>Member since Nov. 2012</small>
								</p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">Profile</a>
								</div>
								<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
								<div class="pull-right">
									<a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					@if (Auth::user()->profile)
						<!-- The user image in the navbar-->
						<img src="{{ asset(Auth::user()->profile->image) }}" class="user-image" alt="User Image">
					@else
						<!-- The user image in the navbar-->
						<img src="{{ asset('images/super-admin.jpg') }}" class="user-image" alt="User Image">
					@endif
				</div>
				<div class="pull-left info">
					<p>{{ Auth::user()->name }}</p>
					<!-- Status -->
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>

			<!-- search form (Optional) -->
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
				</div>
			</form>
			<!-- /.search form -->

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">HEADER</li>
				<li id="dashboard_menu">
					<a href="{{ route('admin.dashboard') }}">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				@if (Auth::user()->role->name == 'SuperAdmin')
					<li id="admins_menu">
						<a href="{{ route('admin.adminusers') }}">
							<i class="fa fa-user-plus"></i> <span>Admins</span>
							<span class="pull-right-container">
								<span class="label label-primary">{{ App\Admin::all()->count() }}</span>
							</span>
						</a>
					</li>
					<li id="service_menu">
						<a href="{{ route('admin.services') }}">
							<i class="fa fa-wrench"></i> <span>Servicios</span>
							<span class="pull-right-container">
								<span class="label label-success">{{ App\Service::where('status', 'active')->count() }}</span>
								<span class="label label-warning">{{ App\Service::where('status', 'inactive')->count() }}</span>
							</span>
						</a>
					</li>
					<li id="user_menu" class="treeview">
						<a href="{{ route('admin.users') }}">
							<i class="fa fa-users"></i> <span>Usuarios</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="user_list_menu">
								<a href="{{ route('admin.users') }}"><i class="fa fa-circle-o"></i> Inicio</a>
							</li>
							<li id="user_new_menu">
								<a href="{{ route('admin.users.new') }}"><i class="fa fa-circle-o"></i> Nuevos</a>
							</li>
							<li id="user_active_menu">
								<a href="{{ route('admin.users.active') }}"><i class="fa fa-circle-o"></i> Activos</a>
							</li>
							<li id="user_jobs_menu">
								<a href="{{ route('admin.users.jobs') }}"><i class="fa fa-circle-o"></i> Solicitudes</a>
							</li>
						</ul>
					</li>
					<li id="worker_menu" class="treeview">
						<a href="#">
							<i class="fa fa-users"></i> <span>Trabajadores</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="worker_list_menu">
								<a href="{{ route('admin.workers') }}"><i class="fa fa-circle-o"></i> Inicio</a>
							</li>
							<li id="worker_new_menu">
								<a href="{{ route('admin.workers.new') }}"><i class="fa fa-circle-o"></i> Nuevos</a>
							</li>
							<li id="worker_active_menu">
								<a href="{{ route('admin.workers.active') }}"><i class="fa fa-circle-o"></i> Activos</a>
							</li>
							<li id="worker_appl_menu">
								<a href="{{ route('admin.workers.applications') }}"><i class="fa fa-circle-o"></i> Aplicaciones</a>
							</li>
							<li id="worker_jobs_menu">
								<a href="{{ route('admin.workers.jobs') }}"><i class="fa fa-circle-o"></i> Contratados</a>
							</li>
						</ul>
					</li>
				@endif
				<li id="finance_menu" class="treeview">
					<a href="#">
						<i class="fa fa-line-chart"></i> <span>Finanzas</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li id="finance_client_payments">
							<a href="{{ route('admin.finance.client.payments') }}">
								<i class="fa fa-circle-o"></i> Pagos pendientes
							</a>
						</li>
						<li id="finance_worker_payments">
							<a href="{{ route('admin.finance.worker.payments') }}">
								<i class="fa fa-circle-o"></i> Pagos realizados
							</a>
						</li>
					</ul>
				</li>
				@if (Auth::user()->role->name == 'SuperAdmin')
					<li id="pages_menu" class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i> <span>Contenido</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="main_page_menu">
								<a href="{{ route('admin.welcome') }}"><i class="fa fa-circle-o"></i> Inicio</a>
							</li>
							{{-- <li id="service_page_menu">
								<a href="{{ route('admin.content.services') }}"><i class="fa fa-circle-o"></i> Servicios</a>
							</li> --}}
							<li id="howto_page_menu">
								<a href="{{ route('admin.howitworks') }}"><i class="fa fa-circle-o"></i> Como funciona</a>
							</li>
							<li id="contact_page_menu">
								<a href="{{ route('admin.contact') }}"><i class="fa fa-circle-o"></i> Ayuda</a>
							</li>
							<li id="privacy_menu">
								<a href="{{ route('admin.privacy') }}"><i class="fa fa-circle-o"></i> Privacidad</a>
							</li>
							<li id="terms_menu">
								<a href="{{ route('admin.terms') }}"><i class="fa fa-circle-o"></i> Términos y condiciones</a>
							</li>
						</ul>
					</li>
					<li id="config_menu">
						<a href="{{ route('admin.config.show') }}">
							<i class="fa fa-cogs"></i> <span>Configuración</span>
						</a>
					</li>
				@endif
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>
	
	
	
	
	
	
	
	
	
	
	
	@yield('content')
	
	
	
	
	
	
	
	
	
	
	
	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane active" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Recent Activity</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:;">
							<i class="menu-icon fa fa-birthday-cake bg-red"></i>

							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

								<p>Will be 23 on April 24th</p>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

				<h3 class="control-sidebar-heading">Tasks Progress</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:;">
							<h4 class="control-sidebar-subheading">
								Custom Template Design
								<span class="pull-right-container">
										<span class="label label-danger pull-right">70%</span>
									</span>
							</h4>

							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

			</div>
			<!-- /.tab-pane -->
			<!-- Stats tab content -->
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<!-- /.tab-pane -->
			<!-- Settings tab content -->
			<div class="tab-pane" id="control-sidebar-settings-tab">
				<form method="post">
					<h3 class="control-sidebar-heading">General Settings</h3>

					<div class="form-group">
						<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked>
						</label>

						<p>
							Some information about this general settings option
						</p>
					</div>
					<!-- /.form-group -->
				</form>
			</div>
			<!-- /.tab-pane -->
		</div>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
	immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
{{-- Rate It --}}
<script src="{{ asset('rateit/jquery.rateit.min.js') }}"></script>

@yield('scripts')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
		 Both of these plugins are recommended to enhance the
		 user experience. -->
</body>
</html>