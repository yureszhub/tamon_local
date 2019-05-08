@extends('admin.header')

@section('content')
<link rel="stylesheet" href="{{ url('/css/multi-select.css') }}">
<div class="large-10 large-offset-1 columns">
	<h1>Modificando la oferta</h1>
	@if(session()->has('msj'))
	  <div data-alert class="aler-box success">
	  	{{ session('msj') }}
	  	<a href="#" class="close">&times;</a>
	  </div>
	@endif
	@if(session()->has('error_msj'))
	  <div data-alert class="aler-box alert">
	  	{{ session('error_msj') }}
	  	<a href="#" class="close">&times;</a>
	  </div>
	@endif
	<form role="form" method="POST" action="{{ route('ofertas.update', $oferta->id) }}" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PUT">
		<input type="text" name="img_actual" style="display: none;" value="{{ $oferta->img_oferta }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="large-12 columns">
			  <label class="label-form">Titulo Oferta:
			  	<input type="text" name="nom_oferta" placeholder="Titulo de la oferta" value="{{ $oferta->nom_oferta }}" required>
			  </label>
			  @if($errors->has('nom_oferta'))
			  <small class="error">{{ $errors->first('nom_oferta') }}</small>
			  @endif
		  </div>
		</div>

		<div class="row">
			<div class="large-12 columns select-oferta">
				<label class="label-form">Escoger productos para la oferta (REQUERIDO):</label>
				<select multiple="multiple" id="mis-productos" name="mis-productos[]" required>
			      @foreach($productos as $p)
				      <option value="{{ $p->id }}" data-precio="{{ $p->precio }}" <?php echo(($productos_oferta->contains('producto_id', $p->id))?"selected":"") ?>>{{ $p->nom_producto }} - S/ {{ $p->precio }}</option>
			      @endforeach
			    </select>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<label class="label-form">Imagen de la oferta:
					<input type="file" name="img_oferta" placeholder="Imagen de la oferta">
				</label>
				@if($errors->has('img_oferta'))
			  	<small class="error">{{ $errors->first('img_oferta') }}</small>
			  	@endif
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<label class="label-form">Descuento:
					<input class="calculo_descuento" type="number" name="descuento" placeholder="Descuento de la oferta en porcentaje positivo" value="{{ $oferta->descuento }}" step="any">
				</label>
				@if($errors->has('descuento'))
			  	<small class="error">{{ $errors->first('descuento') }}</small>
			  	@endif
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<label class="label-form">Precio Oferta:
					<input class="suma_oferta" type="number" name="precio_oferta" placeholder="Precio en soles de la oferta" value="{{ $oferta->precio }}" step="any">
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