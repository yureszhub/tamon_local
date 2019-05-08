@extends('admin.header')

@section('content')
	<div class="large-10 large-offset-1 columns">
		<h3>Ofertas del Día</h3>
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
				  <label>Producto:
				  	<select name="producto_id">
				  		@foreach($productos as $p)
				  		<option value="{{ $p->id }}">{{ $p->nom_producto }} - S/ {{ $p->precio }}</option>
				  		@endforeach
				  	</select>
				  </label>
				  @if($errors->has('producto_id'))
				  <small class="error">{{ $errors->first('producto_id') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label>Descuento:
						<input type="number" name="descuento" placeholder="Descuento del producto en porcentaje positivo">
					</label>
					@if($errors->has('descuento'))
				  	<small class="error">{{ $errors->first('descuento') }}</small>
				  	@endif
				</div>
			</div>

			<div class="row">
			  <div class="large-12 columns">
			    <button type="submit" class="button small">Guardar</button>
			  </div>
			</div>
		</form>
	</div>
@endsection