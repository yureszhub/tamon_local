@extends('admin.header')

@section('content')

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

	@if(isset($oferta))
	@foreach($oferta as $o)
	<form role="form" method="POST" action="{{ route('ofertas.update', $o->id) }}" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PUT">
		{{ csrf_field() }}
		<div class="row">
			<div class="large-12 columns">
			  <label>Nombre:
			  	<input type="text" name="producto_id" value="{{ $o->nom_producto }}" readonly>
			  </label>
		  </div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<label>Descuento:
					<input type="number" name="descuento" value="{{ $o->descuento }}">
				</label>
				@if($errors->has('descuento'))
			  	<small class="error">{{ $errors->first('descuento') }}</small>
			  	@endif
			</div>
		</div>

		<div class="row">
		  <div class="large-12 columns">
		    <button type="submit" class="button large">Modificar</button>
		  </div>
		</div>
	</form>
	@endforeach
	@endif
</div>
@endsection