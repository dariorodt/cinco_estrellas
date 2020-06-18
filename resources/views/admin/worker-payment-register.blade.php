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
				<li><a href="{{ route('admin.finance.client.payments') }}">Pagos</a></li>
				<li class="active">Registrar pago</li>
			</ol>
		</section>

		{{-- Main content --}}
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<form role="form" action="{{ route('admin.finance.payment.register', $payment) }}" method="POST">
							@csrf
							<input type="hidden" name="worker_id" value="{{ $payment->worker_id }}">
							<input type="hidden" name="service_order_id" value="{{ $payment->order_id }}">
							<div class="box-header">
								<h3 class="box-title">Registro de pagos a trabajadores</h3>
							</div>
							{{-- /.box-header --}}
							<div class="box-body">
								<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="f_name" class="control-label">Nombres</label>
											<input type="text" name="f_name" class="form-control" required
											       value="{{ $payment->worker->profile->f_name }}" autofocus>
										</div>
										<div class="form-group">
											<label for="l_name">Apellidos</label>
											<input type="text" name="l_name" class="form-control" required
											       value="{{ $payment->worker->profile->l_name }}">
										</div>
										<div class="form-group">
											<label for="rut">RUT</label>
											<input type="text" name="rut" class="form-control" required
											       value="{{ $payment->worker->rut }}">
										</div>
										<div class="form-group">
											<label for="bank">Banco</label>
											<input type="text" name="bank" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="account">Nro de Cuenta</label>
											<input type="text" name="account" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="email">Correo electrónico</label>
											<input type="text" name="email" class="form-control" required
											       value="{{ $payment->Worker->email }}">
										</div>
										<div class="form-group">
											<label for="amount">Monto del pago</label>
											<input type="number" name="amount" class="form-control" required
											       value="{{ number_format($payment->amount, 0, ",", ".") }}">
										</div>
										<div class="form-group">
											<button class="btn btn-success"><i class="fa fa-check"></i> Registrar</button>
										</div>
									</div>
									<div class="col-md-3"></div>
								</div>
							</div>
						</form>
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
		document.getElementById('finance_client_payments').classList.add('active');
	})();
	
</script>
@endsection