@extends('frontend.header')

@section('content')
	<div class="large-12 page-contact contact-corporativo">
		<div class="row">
		  <div class="small-12 medium-7 large-5 columns">
		  	<h1>Contacto Corporativo</h1>
		  	<form role="form" method="POST" action="{{ url('send-email-corporativo') }}">
				{{ csrf_field() }}
				<div class="row">
			    <div class="small-12 columns">
			      <div class="row">
			        <div class="small-3 columns">
			          <label for="razon_social" class="right inline">Razon Social*:</label>
			        </div>
			        <div class="small-9 columns">
			          <input type="text" name="razon_social" id="razon_social" placeholder="Razon Social">
			        </div>
			        @if($errors->has('razon_social'))
						  <small class="error">{{ $errors->first('razon_social') }}</small>
						  @endif
			      </div>
			    </div>
			  </div>

			  <div class="row">
			    <div class="small-12 columns">
			      <div class="row">
			        <div class="small-3 columns">
			          <label for="ruc" class="right inline">RUC*:</label>
			        </div>
			        <div class="small-9 columns">
			          <input type="text" name="ruc" id="ruc" placeholder="RUC">
			        </div>
			        @if($errors->has('ruc'))
						  <small class="error">{{ $errors->first('ruc') }}</small>
						  @endif
			      </div>
			    </div>
			  </div>

			  <div class="row">
			    <div class="small-12 columns">
			      <div class="row">
			        <div class="small-3 columns">
			          <label for="coorp_direccion" class="right inline">Dirección:</label>
			        </div>
			        <div class="small-9 columns">
			          <input type="text" name="coorp_direccion" id="coorp_direccion" placeholder="Dirección">
			        </div>
			        @if($errors->has('coorp_direccion'))
						  <small class="error">{{ $errors->first('coorp_direccion') }}</small>
						  @endif
			      </div>
			    </div>
			  </div>

			  <div class="row">
			    <div class="small-12 columns">
			      <div class="row">
			        <div class="small-3 columns">
			          <label for="coorp_email" class="right inline">Correo*:</label>
			        </div>
			        <div class="small-9 columns">
			          <input type="email" name="coorp_email" id="coorp_email" placeholder="Correo Electrónico">
			        </div>
			        @if($errors->has('coorp_email'))
						  <small class="error">{{ $errors->first('coorp_email') }}</small>
						  @endif
			      </div>
			    </div>
			  </div>

			  <div class="row">
			    <div class="small-12 columns">
			      <div class="row">
			        <div class="small-3 columns">
			          <label for="coorp_telefono" class="right inline">Teléfono*:</label>
			        </div>
			        <div class="small-9 columns">
			          <input type="text" name="coorp_telefono" id="coorp_telefono" placeholder="Número de teléfono">
			        </div>
			        @if($errors->has('coorp_telefono'))
						  <small class="error">{{ $errors->first('coorp_telefono') }}</small>
						  @endif
			      </div>
			    </div>
			  </div>

				<div class="row">
					<div class="large-12 columns">
					  <label>Mensaje:
					  	<textarea type="text" name="coorp_mensaje" rows="3"></textarea>
					  </label>
					  @if($errors->has('coorp_mensaje'))
					  <small class="error">{{ $errors->first('coorp_mensaje') }}</small>
					  @endif
				  </div>
				</div>

				<div class="row">
				  <div class="large-12 columns">
				    <button type="submit" class="button small">Enviar</button>
				  </div>
				</div>
			</form>
		  </div><!-- .small-12 .medium-7 .large-5 .columns-->
		  <div class="small-12 medium-5 large-7 columns page-contact-right">
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