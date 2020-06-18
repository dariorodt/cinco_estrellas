@extends('layouts.admin')

@section('title', 'Contenido Página de Contacto')

@section('css')
@endsection

@section('content')

	{{-- Content Wrapper. Contains page content --}}
	<div class="content-wrapper">
		{{-- Content Header (Page header) --}}
		<section class="content-header">
			<h1>
				Página de Contacto
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Contacto</li>
			</ol>
		</section>

		{{-- Main content --}}
		<section class="invoice">
			
			<a class="btn btn-primary pull-right" href="{{ route('admin.contact.edit') }}"><i class="fa fa-edit"></i> Editar</a>
			
			{!! $contact_help_text !!}
			
		</section>
	</div>
@endsection

@section('scripts')

<script>
	
	(function() {
		document.getElementById('pages_menu').classList.add('active');
		document.getElementById('contact_page_menu').classList.add('active');
	})()
	
</script>

@endsection

