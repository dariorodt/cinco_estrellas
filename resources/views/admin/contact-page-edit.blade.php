@extends('layouts.admin')

@section('title', 'Contenido Página de Ayuda')

@section('css')
@endsection

@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Página de Ayuda
				<small>Edición de Contenido</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li>Páginas</li>
				<li class="active">Página de Ayuda</li>
			</ol>
		</section>
		
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Página de Ayuda
								<small>Advanced and full of features</small>
							</h3>
							<!-- tools box -->
							<div class="pull-right box-tools">
								<button type="submit" class="btn btn-info btn-sm" title="Guardar" form="privacyForm"><i class="fa fa-save"></i> Guardar</button>
							</div>
							<!-- /. tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body pad">
							<form id="privacyForm" action="{{ route('admin.contact.store') }}" method="POST">
								@csrf
								<textarea id="editor1" name="text" rows="10" cols="80">{!! $contact_help_text !!}</textarea>
							</form>
						</div>
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col-->
			</div>
			<!-- ./row -->
		</section>
		<!-- /.content -->
	</div>
	{{-- /.content-wrapper --}}
@endsection

@section('scripts')
	<!-- CK Editor -->
	<script src="{{ asset('adminlte/bower_components/ckeditor/ckeditor.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<script>
		$(function () {
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			CKEDITOR.replace('editor1')
			//bootstrap WYSIHTML5 - text editor
			$('.textarea').wysihtml5()
		})
	</script>

	<script>
		(function() {
			document.getElementById('pages_menu').classList.add('active');
			document.getElementById('contact_page_menu').classList.add('active');
		})()
	</script>

@endsection

