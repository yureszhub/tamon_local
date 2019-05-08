@extends('frontend.header')

@section('content')
<div class="large-12 columns">
	<div class="large-12 columns content-producto content-producto-vista">
		<div class="large-6 columns box-images-zoom">
			<img id="img_01" src="{{ url('imgProductos_400/' . $oferta->img_oferta) }}" data-zoom-image="{{ url('imgProductos/' . $oferta->img_oferta) }}"/>
			<div id="gal1">
				<a class="active" href="#" data-image="{{ url('imgProductos_400/' . $oferta->img_oferta) }}" data-zoom-image="{{ url('imgProductos/' . $oferta->img_oferta) }}">
				    <img id="img_01" src="{{ url('imgProductos_100/' . $oferta->img_oferta) }}" />
				</a>

				@foreach($productos as $p)
				<a href="#" data-image="{{ url('imgProductos_400/' . $p->img_producto) }}" data-zoom-image="{{ url('imgProductos/' . $p->img_producto) }}">
				    <img id="img_01" src="{{ url('imgProductos_100/' . $p->img_producto) }}" />
				</a>
				@endforeach
			</div>
		</div>
		<div class="large-6 columns">
			<h1 class="titulo-show">{{ $oferta->nom_oferta }}</h1>
			<div class="box-detalles-oferta">
				<h4>Productos en la oferta:</h4>
				<ul>
					<?php $suma = 0; ?>
					@foreach($productos as $pr)
					<?php $suma += $pr->precio; ?>
					<li>{{ $pr->nom_producto }} <span class="oferta-precio-normal"> - Precio normal: S/{{ $pr->precio }}</span><a href="{{ route('producto', ['id'=>$pr->producto_id]) }}"> ver producto</a></li>
					@endforeach
				</ul>
			</div>
			<div class="box-precio-normal">
				<strong>Precio Normal: </strong><span class="precio-normal-tachado">S/{{ number_format($suma, 2, '.', ',') }}</span><span class="box-descuento">Descuento: - {{ $oferta->descuento }}%</span>
			</div>
			<div class="box-precio-final">
				<strong>Precio Final: </strong><span class="precio-con-descuento">S/{{ $oferta->precio }}</span>
			</div>
			<div class="box-button-cart">
				<a href="{{ route('producto.agregar_al_carrito', ['tipo' => 'o','id' => $oferta->id]) }}" class="button large success button-agregar-carrito"><i class="fa fa-cart-plus" aria-hidden="true"></i> Agregar al carro</a>
			</div>
		</div>
	</div>
</div>
@endsection