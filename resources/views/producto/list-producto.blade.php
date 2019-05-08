@extends('admin.header')

@section('content')
	<script type="text/javascript">
		function ConfirmDelete(codigo,nombre) {
			var x = confirm('Esta seguro de eliminar el siguiente producto?\nCodigo Producto: ' + codigo + '\nNombre Producto: ' + nombre);
			if (x)
				return true;
			else
				return false;
		}
	</script>
	<div class="large-10 large-offset-1 columns dashboard-content">
		<div class="header-list">
			<h2>Lista de Productos</h2>
		</div>
		<div class="clear"></div>
		{!! Form::open(['route' => 'productos.index', 'method' => 'GET', 'role' => 'search']) !!}
					<div class="row collapse rox-form-search">
						<div class="small-10 columns">
				          {!! Form::text('name', null, ['placeholder' => 'Buscar producto por nombre']) !!}
				        </div>
				        <div class="small-2 columns">
				          <button type="submit" class="button postfix">Buscar</button>
				        </div>
					</div>
		{!! Form::close() !!}
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th class="colum_description">Descripción</th>
					<th width="200">Imagen</th>
					<th class="colum_precio_anterior">Precio Anterior</th>
					<th>Precio Actual</th>
					<th class="colum_categoria">Categoria</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($productos as $p)
				<tr>
					<td>{{ $p->id }}</td>
					<td>{{ $p->nom_producto }}</td>
					<td class="colum_description">{!! $p->desc_producto !!}</td>
					<td>
						<a class="th" href="#">
  						<img src="imgProductos_215/{{ $p->img_producto }}">
						</a>
					</td>
					<td class="colum_precio_anterior">{{ $p->precio_anterior }}</td>
					<td>{{ $p->precio }}</td>
					<td class="colum_categoria">
						<?php 
							if ($categorias->contains('id', $p->categoria_id)) {
								$value = $categorias->where('id', $p->categoria_id)->first();
								$nombre = $value->nom_categoria;
								echo($nombre);
							}
						?>
					</td>
					<td>
						<a href="productos/{{ $p->id }}/edit" class="button small">Modificar</a>
						<form action="{{ route('productos.destroy', $p->id) }}" method="POST" onsubmit="return ConfirmDelete('{{ $p->id }}', '{{ $p->nom_producto }}')">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="DELETE">
							<input type="submit" class="button small alert" value="Eliminar">
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $productos->links() }}
	</div>

@endsection