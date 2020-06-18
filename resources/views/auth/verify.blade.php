@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Gracias por elegir los servicios de Cinco Estrellas.</div>

				<div class="card-body">
					<p>Para nosotros es muy importante la identidad de nuestros usuario. Por eso te pedimos que verifiques tu dirección de e-mail antes de comenzar.</p>
					<p>Recuerda que para poder activar tu cuenta, debes llenar los datos de tu perfil y suministrar los documentos solicitados.</p>
					Si no has recibido el email, <a href="{{ route('verification.resend') }}">click aquí para enviar otro</a>.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
