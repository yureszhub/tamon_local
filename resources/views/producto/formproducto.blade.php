@extends('admin.header')

@section('content')
	<div class="large-10 large-offset-1 columns">
		<h3>Agregar nuevo producto</h3>
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
		<form role="form" method="POST" action="{{ url('productos') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="large-12 columns">
				  <label>Nombre:
				  	<input type="text" name="nom_producto" placeholder="Nombre del Producto">
				  </label>
				  @if($errors->has('nom_producto'))
				  <small class="error">{{ $errors->first('nom_producto') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
				<div class="large-12 columns">
				  <label>Descripción:
				  	<textarea id="textareatiny" type="text" name="desc_producto" placeholder="Descripción del producto"></textarea>
				  </label>
				  @if($errors->has('desc_producto'))
				  <small class="error">{{ $errors->first('desc_producto') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
				<div class="large-12 columns">
				  <label>Imagen:
				  	<input type="file" name="img_producto" placeholder="Imagen del producto">
				  </label>
				  @if($errors->has('img_producto'))
				  <small class="error">{{ $errors->first('img_producto') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
			  <div class="large-12 columns">
			  	<label>Precio Anterior:
			  		<input type="text" name="precio_anterior" placeholder="Precio anterior del producto">
			  	</label>
			  	@if($errors->has('precio_anterior'))
				  <small class="error">{{ $errors->first('precio_anterior') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
			  <div class="large-12 columns">
			  	<label>Precio Actual *(requerido):
			  		<input type="text" name="precio" placeholder="Precio del producto">
			  	</label>
			  	@if($errors->has('precio'))
			  	<small class="error">{{ $errors->first('precio') }}</small>
			  	@endif
			  </div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label>Categoria:
					  	<select name="categoria_id">
					  		@foreach($categorias as $c)
					  		<option value="{{ $c->id }}">{{ $c->nom_categoria }}</option>
					  		@endforeach
					  	</select>
				  	</label>
				  	@if($errors->has('categoria_id'))
				  	<small class="error">{{ $errors->first('categoria_id') }}</small>
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
	<script src="{{ url('js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript">
		tinymce.init({
		  selector: '#textareatiny',  // change this value according to your HTML
		  plugins : 'advlist autolink lists charmap preview'
		});
	</script>
@endsection