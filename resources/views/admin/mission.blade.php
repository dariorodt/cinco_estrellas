@extends('layouts.admin')

@section('title', 'Misión')

@section('css')
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Misión
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Misión</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="invoice">
			
			<a class="btn btn-primary pull-right" href="{{ route('admin.mission.edit') }}"><i class="fa fa-edit"></i> Editar</a>
			
			{!! $mission_text !!}
			
		</section>
		<div class="clearfix"></div>
	</div>
@endsection

@section('scripts')

<script>
	(function() {
		document.getElementById('pages_menu').classList.add('active');
		document.getElementById('mission_menu').classList.add('active');
	})()
</script>

@endsection