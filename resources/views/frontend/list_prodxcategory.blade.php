@extends('frontend.header')

@section('content')

<div class="small-5 small-centered columns titulo-categoria">
	<h2 class="text-center">{{ $categoria->nom_categoria }}</h2>
</div>
<div class="large-12 columns content-owl-carousel">
	<div class="row-carousel">
		<div class="large-10 large-offset-1 columns">
			<div class="owl-carousel owl-theme slider-carousel" id="slider-carousel-category">
				@foreach($productos as $p)
					<div class="item owl-animated-out item-carousel">
						
						@if($p->descuento !== null)
							<a href="{{ route('producto', ['id'=>$p->id]) }}">
								<figure>
									<img src="{{ url('imgProductos_215/' . $p->img_producto) }}">
								</figure>
								<div class="detalles">
									<span class="mitad precio_sin_oferta">S/ {{ $p->precio }}</span>
									<span class="mitad descuento">-{{ $p->descuento }}% dto.</span>
									<p class="precio_con_oferta">S/ {{ number_format($p->precio - (($p->precio * $p->descuento) / 100), 2, '.', ',') }}</p>
									<p class="titulo-item-oferta">{{ $p->nom_producto }}</p>
								</div>
							</a>
							<span class="etiqueta-oferta">-{{ $p->descuento }}%</span>
						@else
							<a href="{{ route('producto', ['id'=>$p->id]) }}">
								<figure>
									<img src="{{ url('imgProductos_215/' . $p->img_producto) }}">
								</figure>
								<div class="detalles">
									<span class="precio_anterior">S/ {{ $p->precio_anterior }}</span>
									<p class="precio_con_oferta">S/ {{ $p->precio }}</p>
									<p class="title_elemento">{{ $p->nom_producto }}</p>
								</div>
							</a>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@endsection