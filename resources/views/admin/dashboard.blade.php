@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/morris.js/morris.css') }}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard
				<small>Control panel</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>{{ $new_clients }}</h3>

							<p>Nuevos Clientes</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="{{ route('admin.users') }}" class="small-box-footer">Más... <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>{{ $new_workers }}</h3>

							<p>Nuevos Trabajadores</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="{{ route('admin.workers') }}" class="small-box-footer">Más... <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-turquoise1">
						<div class="inner">
							<h3>{{ $applications }}</h3>

							<p>Número de Aplicaciones</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="{{ route('admin.services') }}" class="small-box-footer">Más... <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>{{ $payments }}</h3>

							<p>Volúmen de Contrataciones</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="{{ route('admin.finance.client.payments') }}" class="small-box-footer">Más... <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12">
					<!-- solid sales graph -->
					<div class="box box-solid bg-teal-gradient">
						<div class="box-header">
							<i class="fa fa-th"></i>

							<h3 class="box-title">Sales Graph</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
								</button>
							</div>
						</div>
						<div class="box-body border-radius-none">
							<div class="chart" id="line-chart" style="height: 250px;"></div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</section>
				<!-- /.Left col -->
				
			</div>
			<!-- /.row (main row) -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

@endsection

@section('scripts')

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="{{ asset('adminlte/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/js/pages/dashboard.js') }}"></script>

<script>
	
	(function() {
		document.getElementById('dashboard_menu').classList.add('active');
		
		$.get("//localhost:8000/api/finance/get-daily-sales/10", function (data, status) {
			console.log(status);
			console.log(data);
			var line = new Morris.Line({
				element          : 'line-chart',
				resize           : true,
				data             : data,
				xkey             : 'y',
				ykeys            : ['item1'],
				labels           : ['Item 1'],
				lineColors       : ['#efefef'],
				lineWidth        : 2,
				hideHover        : 'auto',
				gridTextColor    : '#fff',
				gridStrokeWidth  : 0.4,
				pointSize        : 4,
				pointStrokeColors: ['#efefef'],
				gridLineColor    : '#efefef',
				gridTextFamily   : 'Open Sans',
				gridTextSize     : 10
			});
		});
		
		// Gráfico de ventas diarias(?).
	})()
	
</script>

@endsection

