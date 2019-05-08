@extends('admin.header')

@section('content')
	<div class="large-8 large-offset-2 columns dashboard-content">
		<h2>Formulario para la tabla Categoria</h2>
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
		<form role="form" method="POST" action="{{ url('categorias') }}">
			{{ csrf_field() }}
			<div class="row">
				<div class="large-12 columns">
				  <label>Nombre:
				  	<input type="text" name="nom_categoria" placeholder="Nombre de la Categoria">
				  </label>
				  @if($errors->has('nom_categoria'))
				  <small class="error">{{ $errors->first('nom_categoria') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
				<div class="large-12 columns">
				  <label>Descripción:
				  	<textarea type="text" name="desc_categoria" placeholder="Descripción de la Categoria"></textarea>
				  </label>
				  @if($errors->has('desc_categoria'))
				  <small class="error">{{ $errors->first('desc_categoria') }}</small>
				  @endif
			  </div>
			</div>

			<div class="row">
			  <div class="large-12 columns">
			    <button type="submit" class="button large">Guardar</button>
			  </div>
			</div>
		</form>
	</div>
@endsection