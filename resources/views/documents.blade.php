@extends('layouts.site')

@section('title', 'Documentos de cliente')

@section('css')
@endsection

@section('content')


	<!-- Inner Banner -->
	<section id="inner-banner-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12 text-center">
					<div class="inner_banner_2_detail">
						<h2>Mi Perfil</h2>
						<p><a href="index.html">Home</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Perfil</p>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Inner Banner -->

	<!-- Profile -->
	<section id="listing-details" class="p_b70 p_t70 bg_lightgry">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="profile-leftbar">
						<div id="profile-picture" class="profile-picture">
							@if ($user->profile)
								<img src="{{ asset($user->profile->image_path) }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@else
								<img src="{{ asset('images/profile.jpg') }}" alt="" width="100%" height="100%" style="object-fit: cover;">
							@endif
						</div>
					</div>

					@component('partials.client-panel-menu')
					@endcomponent
				</div>

				<div class="col-md-9 col-sm-9 col-xs-12">
					@foreach ($errors->all() as $message)
						<div class="alert alert-warning">
							{{ $message }}
						</div>
					@endforeach
					
					@if (session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('success') }}
						</div>
					@endif
					
					@if (session('warning'))
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('warning') }}
						</div>
					@endif
					
					<div class="profile-login-bg">
						<h2><span><i class="fa fa-files"></i></span> Mis <span>Documentos</span></h2>
						<div class="row p_b30">
							<div class="col-md-12">
								<div class="form-group">
									<button onclick="location.href='{{ route('user.document.upload') }}'">
										<i class="fa fa-upload"></i> Registrar documento
									</button>
								</div>
							</div>
							<div class="col-md-12">
								<table class="table table-striped" role="table">
									<thead>
										<tr>
											<th>Documento</th>
											<th>Archivo</th>
											<th>Tipo</th>
											<th>Registrado el</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($my_documents as $this_document)
											<tr>
												<td>{{ $this_document->name }}</td>
												<td>{{ substr($this_document->file_path, 8) }}</td>
												<td>{{ $this_document->file_type }}</td>
												<td>{{ $this_document->created_at->format('d-m-Y') }}</td>
												<td>
													<a class="btn btn-info btn-sm" href="{{ route('user.document.edit', $this_document->id) }}"><i class="fa fa-edit"></i></a>
													<form action="{{ route('user.document.delete', $this_document->id) }}" method="POST" style="display: inline;">
														@csrf
														@method('DELETE')
														<button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-times"></i></button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section('script')
@endsection
