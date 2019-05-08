@extends('admin.header')

@section('content')
<div class="large-10 large-offset-1 columns">
	<h1>Modificando la categoria "{{ $categoria->nom_categoria }}"</h1>
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

	@if(isset($categoria))
	<form role="form" method="POST" action="{{ route('categorias.update', $categoria->id) }}" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PUT">
		{{ csrf_field() }}
		<div class="row">
			<div class="large-12 columns">
			  <label>Nombre:
			  	<input type="text" name="nom_categoria" placeholder="Nombre de la Categoria" value="{{ $categoria->nom_categoria }}">
			  </label>
			  @if($errors->has('nom_categoria'))
			  <small class="error">{{ $errors->first('nom_categoria') }}</small>
			  @endif
		  </div>
		</div>

		<div class="row">
			<div class="large-12 columns">
			  <label>Descripción:
			  	<textarea type="text" name="desc_categoria" placeholder="Descripción de la categoria">{{ $categoria->desc_categoria }}</textarea>
			  </label>
			  @if($errors->has('desc_categoria'))
			  <small class="error">{{ $errors->first('desc_categoria') }}</small>
			  @endif
		  </div>
		</div>

		<div class="row">
		  <div class="large-12 columns">
		    <button type="submit" class="button large">Modificar</button>
		  </div>
		</div>
	</form>
	@endif
</div>
@endsection