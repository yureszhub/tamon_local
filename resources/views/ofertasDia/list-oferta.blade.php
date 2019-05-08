@extends('admin.header')

@section('content')
	<div class="large-10 large-offset-1 columns dashboard-content">
		<div class="header-list">
			<h2>Ofertas del Día</h2>
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
					<th>ID</th>
					<th>Producto</th>
					<th width="250">Imagen</th>
					<th>Precio</th>
					<th>Descuento</th>
					<th>Precio Calculado</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($ofertas as $o)
				<tr>
					<td>{{ $o->id }}</td>
					<td>{{ $o->nom_producto }}</td>
					<td>
						<a class="th" href="#">
  						<img src="imgProductos/{{ $o->img_producto }}">
						</a>
					</td>
					<td>S/{{ $o->precio }}</td>
					<td>{{ $o->descuento }}%</td>
					<td>S/{{ number_format($o->precio - (($o->precio)*($o->descuento)/100), 2, '.', ',') }}</td>
					<td>
						<a href="ofertas/{{ $o->id }}/edit" class="button small">Modificar</a>
						<form action="{{ route('ofertas.destroy', $o->id) }}" method="POST" id="eliminarOferta">
							<input type="hidden" name="_method" value="DELETE">
							{{ csrf_field() }}
							<button class="button small alert">Eliminar</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection