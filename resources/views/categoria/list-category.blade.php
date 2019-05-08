@extends('admin.header')

@section('content')
	<script type="text/javascript">
		function ConfirmDelete(nombre) {
			var x = confirm('Esta seguro de eliminar la siguiente categoria?\nNombre Categoria: ' + nombre);
			if (x)
				return true;
			else
				return false;
		}
	</script>
  <div class="large-10 large-offset-1 columns dashboard-content list-categorias">
  	<div class="header-list">
  		<h2>Lista de Categorias</h2>	
  	</div>
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
	  <table>
		  <thead>
		    <tr>
		      <th width="100">ID</th>
		      <th>Nombre</th>
		      <th>Descripción</th>
		      <th width="180">Acción</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach($categorias as $categoria)
	    	<tr>
		    	<td>{{ $categoria->id }}</td>
		    	<td>{{ $categoria->nom_categoria}}</td>
		    	<td>{{ $categoria->desc_categoria }}</td>
		    	<td>
		    		<a href="categorias/{{ $categoria->id }}/edit" class="button small">Modificar</a>
					<form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline-block" onsubmit="return ConfirmDelete('{{ $categoria->nom_categoria }}')">
						<input type="hidden" name="_method" value="DELETE">
						{{ csrf_field() }}
						<input type="submit" class="button small alert" value="Eliminar">
					</form>
		    	</td>
	    	</tr>
		    @endforeach
		  </tbody>
		</table>
  </div>
@endsection