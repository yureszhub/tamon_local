@extends('frontend.header')

@section('content')
	<div class="large-12 page-contact contact-personal">
		<div class="row">
		  <div class="small-7 medium-6 large-5 columns">
		  	<h1>Contacto Personal</h1>
		  	<form role="form" method="POST" action="{{ url('send-email-personal') }}">
				{{ csrf_field() }}
				<div class="row">
					<div class="large-12 columns">
					  <label>Nombre*:
					  	<input type="text" name="contacto_nombres" placeholder="Nombre">
					  </label>
					  @if($errors->has('contacto_nombres'))
					  <small class="error">{{ $errors->first('contacto_nombres') }}</small>
					  @endif
				  </div>
				</div>

				<div class="row">
					<div class="large-12 columns">
					  <label>Correo*:
					  	<input type="email" name="contacto_email" placeholder="Ej: correo@hotmail.com">
					  </label>
					  @if($errors->has('contacto_email'))
					  <small class="error">{{ $errors->first('contacto_email') }}</small>
					  @endif
				  </div>
				</div>

				<div class="row">
					<div class="large-12 columns">
					  <label>Teléfono:
					  	<input type="text" name="contacto_telefono" placeholder="Número de teléfono">
					  </label>
					  @if($errors->has('contacto_telefono'))
					  <small class="error">{{ $errors->first('contacto_telefono') }}</small>
					  @endif
				  </div>
				</div>

				<div class="row">
					<div class="large-12 columns">
					  <label>Mensaje:
					  	<textarea type="text" name="contacto_mensaje"></textarea>
					  </label>
					  @if($errors->has('contacto_mensaje'))
					  <small class="error">{{ $errors->first('contacto_mensaje') }}</small>
					  @endif
				  </div>
				</div>

				<div class="row">
				  <div class="large-12 columns">
				    <button type="submit" class="button small">Enviar</button>
				  </div>
				</div>
			</form>
		  </div><!-- small-7 medium-6 large-5 columns -->
		  <div class="small-5 medium-6 large-7 columns page-contact-right">
		  	<div class="row">
		  		<div class="small-8 small-centered columns text-center">
		  			<h2>Comuniquese al numero</h2>
		  			<span>#9892349234</span>
		  		</div>
		  	</div>
		  </div><!-- .small-12 .medium-5 .large-7 .columns -->
		</div>
	</div>
@endsection