@extends('frontend.header')

@section('content')
<div class="large-12 columns">
	<div class="large-12 columns content-producto content-producto-vista">
	@foreach($producto as $p)
		<div class="large-6 columns">
			<figure>
				<img id="zoom_01" src="{{ url('imgProductos_400/' . $p->foto) }}" data-zoom-image="{{ url('imgProductos/' . $p->foto) }}"/>
			</figure>
		</div>
		<div class="large-6 columns">
			<h2 class="titulo-show">{{ $p->nombre }}</h2>
			<div class="box-detalles-oferta">
				<h4>Características del producto: </h4>
				{!! $p->descripcion !!}
			</div>
			<div class="box-precio-final">
				<strong>Precio Actual : </strong><span class="precio-con-descuento">S/{{ $p->precio_unitario }}</span>
			</div>
			<div class="box-button-cart">
				<a href="{{ route('producto.agregar_al_carrito', ['tipo' => 'p','id' => $p->id]) }}" class="button large success button-agregar-carrito"><i class="fa fa-cart-plus" aria-hidden="true"></i> Agregar al carro</a>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection