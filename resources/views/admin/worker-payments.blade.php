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
				<li class="active">Pagos a Trabajadores</li>
			</ol>
		</section>

		{{-- Main content --}}
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Listado de Pagos a Trabajadores</h3>
						</div>
						{{-- /.box-header --}}
						<div class="box-body">
							{{-- DataTable --}}
							<table id="payments-list" class="table table-striped">
								<thead>
									<tr>
										<th>Trabajador</th>
										<th>Solicitud</th>
										<th>Recibido por</th>
										<th>Banco</th>
										<th>Cuenta</th>
										<th>Monto</th>
										<th>Fecha</th>
										<th width="40">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($payments as $payment)
										<tr>
											<td>
												<a href="{{ route('admin.worker.edit', $payment->worker_id) }}">
													{{ $payment->worker->profile->full_name() }}
												</a>
											</td>
											<td>#{{ $payment->service_order_id }}: {{ $payment->service_order->service->name }}</td>
											<td>{{ $payment->full_name() }}</td>
											<td>{{ $payment->bank }}</td>
											<td>{{ $payment->account }}</td>
											<td>{{ number_format($payment->amount, 0, ",", ".") }}</td>
											<td>{{ $payment->created_at }}</td>
											<td>
												<a class="btn btn-primary btn-xs" href="{{ route('admin.finance.show.payment', $payment) }}" title="Ver registro"><i class="fa fa-eye"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
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