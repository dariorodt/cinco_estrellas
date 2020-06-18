@extends('layouts.admin')

@section('title', 'Contenido Página de Servicios')

@section('css')
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Página de Servicios
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Servicios</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		</section>
	</div>
@endsection

@section('scripts')

<script>
	
	(function() {
		document.getElementById('pages_menu').classList.add('active');
		document.getElementById('service_page_menu').classList.add('active');
	})()
	
</script>

@endsection