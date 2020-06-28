@extends('layouts.admin')

@section('title', 'Configuración')

@section('css')
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Configuración de la aplicación
				<small>Control panel</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Configuración</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-xs-12">
					
					@if (session('success'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> ¡Éxito!</h4>
							{{ $success }}.
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-warning"></i> ¡Advertencia!</h4>
							{{ $warning }}.
						</div>
					@endif
					
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Crear nuevo Usuario Admin</h3>
						</div>
						
						<div class="box-body">
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form role="form" action="{{ route('admin.config.update') }}" method="POST">
										@csrf
										<div class="form-group">
											<label for="role_id" class="control-label">Indique el procentaje</label>
											<input type="number" name="express_percentage" 
											       value="{{ $express_percentage }}" 
											       class="form-control" min="0.5" max="100" step="0.5">
										</div>
										<div class="form-group">
											<input type="submit" class="form-control btn btn-default" value="Actualizar">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		
		(function () {
			document.getElementById('config_menu').classList.add('active');
		})();
		
	</script>
@endsection