@extends('admin.header')

@section('content')
<div class="large-10 large-offset-1 columns">
	<h3>Modificando el producto "{{ $producto->nom_producto }}"</h3>
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

		@if(isset($producto))
		<form role="form" method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
			<input name="_method" type="hidden" value="PUT">
			<input type="text" name="img_actual" style="display: none;" value="{{ $producto->img_producto }}">
			{{ csrf_field() }}
			<div class="row">
				<div class="large-12 columns">
				  <label>Nombre:
				  	<input type="text" name="nom_producto" placeholder="Nombre del Producto" value="{{ $producto->nom_producto }}">
				  </label>
				  @if($errors->has('nom_producto'))
				  <small class="error">{{ $errors->first('nom_producto') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
				<div class="large-12 columns">
				  <label>Descripción:
				  	<textarea id="textareeditatiny" type="text" name="desc_producto" placeholder="Descripción del producto">{{ $producto->desc_producto }}</textarea>
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
			  		<input type="text" name="precio_anterior" placeholder="Precio anterior del producto" value="{{ $producto->precio_anterior }}">
			  	</label>
			  	@if($errors->has('precio_anterior'))
				  <small class="error">{{ $errors->first('precio_anterior') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
			  <div class="large-12 columns">
			  	<label>Precio Actual *requerido:
			  		<input type="text" name="precio" placeholder="Precio del producto" value="{{ $producto->precio }}">
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
					  		<option value="{{ $c->id }}" <?php echo(($producto->categoria_id == $c->id)?"selected":"") ?>>
					  			{{ $c->nom_categoria }}
					  		</option>
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
			    <button type="submit" class="button small">Modificar</button>
			  </div>
			</div>
		</form>
		@endif
</div>
<script src="{{ url('js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
	  selector: '#textareeditatiny',  // change this value according to your HTML
	  plugins : 'advlist autolink lists charmap preview'
	});
</script>
@endsection