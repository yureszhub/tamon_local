@extends('frontend.header')

@section('content')
<div class="row" style="padding: 2rem 0rem">
	<div class="content-producto">
		<div class="large-6 columns text-center">
			<figure>
				<img id="zoom_01" src="{{ url('imgProductos_400/' . $producto->foto) }}" data-zoom-image="{{ url('imgProductos/' . $producto->foto) }}"/>
			</figure>
		</div>
		<div class="large-6 columns">
			<h1 class="titulo-show">{{ $producto->nombre }}</h1>
			@if (!is_null($producto->descuento))
				<h3 class="porcentaje_descuento">{{ $producto->descuento }} % descuento</h3>
			@endif
			<div class="box-precio">
				@if (is_null($producto->descuento))
					<strong>S/ {{ $producto->precio_unitario }}</strong>
				@else
					<p class="price-product-with-offer">
						<span class="price-old">S/ {{ $producto->precio_unitario }}</span>
						<span class="price-con-descuento">S/ {{  $producto->precio_unitario - ($producto->precio_unitario * ($producto->descuento/100))  }}</span>
					</p>
				@endif
			</div>

			<div class="box-detalles">
				{!! $producto->descripcion !!}
			</div>
			<div class="box-button-cart">
				<a href="{{ route('producto.agregar_al_carrito', ['tipo' => 'p','id' => $producto->id]) }}" class="button small success button-agregar-carrito">
				AGREGAR A MI BOLSA
				</a>
			</div>
		</div>
	</div>
</div>
@endsection