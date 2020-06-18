@extends('layouts.admin')

@section('title', 'Pagos a Trabajadores')

@section('css')
	{{-- DataTable CSS --}}
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Pagos a Trabajadores
				<small>Administración de Finanzas</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Finanzas</li>
				<li><a href="{{ route('admin.finance.worker.payments') }}">Pagos</a></li>
				<li class="active">Registro de pago</li>
			</ol>
		</section>

		{{-- Main content --}}
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Registro de pagos a trabajadores</h3>
						</div>
						{{-- /.box-header --}}
						<div class="box-body">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<table class="table table-striped">
										<tr><td><strong>Trabajador</strong></td><td>{{ $payment->worker->profile->full_name() }}</td></tr>
										<tr>
											<td><strong>Solicitud de servicio</strong></td>
											<td>
												{{ $payment->service_order->id }} - {{ $payment->service_order->service->name }} del {{ $payment->service_order->created_at->isoFormat('L') }}
											</td>
										</tr>
										<tr><td><strong>Pagado el</strong></td><td>{{ $payment->created_at->isoFormat('LL') }}</td></tr>
										<tr><td><strong>Banco</strong></td><td>{{ $payment->bank }}</td></tr>
										<tr><td><strong>A nombre de</strong></td><td>{{ $payment->full_name() }}</td></tr>
										<tr><td><strong>RUT</strong></td><td>{{ $payment->rut }}</td></tr>
										<tr><td><strong>Nro de cuenta</strong></td><td>{{ $payment->account }}</td></tr>
										<tr><td><strong>Email</strong></td><td>{{ $payment->email }}</td></tr>
										<tr><td><strong>Monto</strong></td><td>{{ number_format($payment->amount, 0, ",", ".") }}</td></tr>
									</table>
								</div>
								<div class="col-md-3"></div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection

@section('scripts')
{{-- DataTables --}}
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
{{-- SlimScroll --}}
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
{{-- FastClick --}}
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>

<script>
	
	$(function () {
		$('#payments-list').DataTable({
			'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		})
	});
	
	(function() {
		document.getElementById('finance_menu').classList.add('active');
		document.getElementById('finance_worker_payments').classList.add('active');
	})();
	
</script>
@endsection