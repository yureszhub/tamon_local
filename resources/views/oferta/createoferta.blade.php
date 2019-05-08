@extends('admin.header')

@section('content')
<link rel="stylesheet" href="{{ url('/css/multi-select.css') }}">
	<div class="large-10 large-offset-1 columns">
		<h3>Agregar nueva oferta</h3>
		@if(session()->has('msj'))
		  <div data-alert class="alert-box success">
		  	{{ session('msj') }}
		  	<a href="#" class="close">&times;</a>
		  </div>
		@endif
		@if(session()->has('error_msj'))
		  <div data-alert class="alert-box alert">
		  	{{ session('error_msj') }}
		  	<a href="#" class="close">&times;</a>
		  </div>
		@endif
		<form role="form" method="POST" action="{{ url('ofertas') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="large-12 columns">
				  <label>Titulo Oferta (REQUERIDO):
				  	<input type="text" name="nom_oferta" placeholder="Titulo de la oferta" required>
				  </label>
				  @if($errors->has('nom_oferta'))
				  <small class="error">{{ $errors->first('nom_oferta') }}</small>
				  @endif
			  </div>
			</div>
			<div class="row">
				<div class="large-12 columns select-oferta">
					<label>Escoger productos para la oferta (REQUERIDO):</label>
					<select multiple="multiple" id="mis-productos" name="mis-productos[]" required>
				      @foreach($productos as $p)
				      <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">{{ $p->nom_producto }} - S/ {{ $p->precio }}</option>
				      @endforeach
				    </select>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label>Imagen de la oferta (REQUERIDO):
						<input type="file" name="img_oferta" placeholder="Imagen de la oferta" required>
					</label>
					@if($errors->has('img_oferta'))
				  	<small class="error">{{ $errors->first('img_oferta') }}</small>
				  	@endif
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label>Descuento en porcentaje:
						<input class="calculo_descuento" type="number" name="descuento" placeholder="Descuento de la oferta en porcentaje positivo" value="0.00">
					</label>
					@if($errors->has('descuento'))
				  	<small class="error">{{ $errors->first('descuento') }}</small>
				  	@endif
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label>Precio Oferta:
						<input class="suma_oferta" type="number" name="precio_oferta" placeholder="Precio en soles de la oferta" step="any" value="0.00">
					</label>
					@if($errors->has('precio'))
				  	<small class="error">{{ $errors->first('precio') }}</small>
				  	@endif
				</div>
			</div>

			<input class="input_precioNormal" type="text" name="precioNormal" style="display: none;">

			<div class="row">
			  <div class="large-12 columns">
			    <button type="submit" class="button small">Guardar</button>
			  </div>
			</div>
		</form>
	</div>
@endsection