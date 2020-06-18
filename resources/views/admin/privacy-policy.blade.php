@extends('layouts.admin')

@section('title', 'Contenido Politicas de Privacidad')

@section('css')
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Politicas de Privacidad
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Politicas de Privacidad</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="invoice">
			
			<a class="btn btn-primary pull-right" href="{{ route('admin.privacy.edit') }}"><i class="fa fa-edit"></i> Editar</a>
			
			{!! $privacy_policy_text !!}
			
		</section>
		<div class="clearfix"></div>
	</div>
@endsection

@section('scripts')

	<script>
		(function() {
			document.getElementById('pages_menu').classList.add('active');
			document.getElementById('privacy_menu').classList.add('active');
		})()
	</script>

@endsection