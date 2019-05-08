@extends('admin.header')

@section('content')
	<script type="text/javascript">
		function ConfirmDelete(codigo,nombre) {
			var x = confirm('Esta seguro de eliminar la siguiente oferta?\nCodigo Oferta: ' + codigo + '\nNombre Oferta: ' + nombre);
			if (x)
				return true;
			else
				return false;
		}
	</script>
	<div class="large-10 large-offset-1 columns dashboard-content">
		<div class="header-list">
			<h2>Lista de Ofertas</h2>
		</div>
		<div class="clear"></div>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Titulo</th>
					<th width="200">Imagen</th>
					<th>Descuento</th>
					<th>Precio</th>
					<th>Productos</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($ofertas as $o)
				<tr>
					<td>{{ $o->id }}</td>
					<td>{{ $o->nom_oferta }}</td>
					<td>
						<a class="th" href="#">
							<img src="imgProductos_215/{{ $o->img_oferta }}">
						</a>
					</td>
					<td>- {{ $o->descuento }} %</td>
					<td>{{ $o->precio }}</td>
					<td>
						<ul>
						@foreach($products as $product)
							@if ($product->oferta_id === $o->id)
								<li>{{ $product->nom_producto }}</li>
							@endif
						@endforeach
						</ul>
					</td>
					<td>
						<a href="ofertas/{{ $o->id }}/edit" class="button small">Modificar</a>
						<form action="{{ route('ofertas.destroy', $o->id) }}" method="POST" onsubmit="return ConfirmDelete('{{ $o->id }}', '{{ $o->nom_oferta }}')">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="DELETE">
							<input type="submit" class="button small alert" value="Eliminar">
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection