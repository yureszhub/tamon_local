@extends('frontend.header')

@section('content')

<div class="small-5 small-centered columns titulo-categoria">
	<h2 class="text-center">{{ $categoria->name }}</h2>
</div>
<div class="large-12 columns">
	<div class="row">
		@foreach($productos as $p)
		<div class="large-3 columns">
			<div class="item owl-animated-out item-carousel">
				
				@if($p->descuento !== null)
					<a href="{{ route('producto', ['id'=>$p->id]) }}">
						<figure>
							<img src="{{ url('imgProductos_215/' . $p->foto) }}">
						</figure>
						<div class="detalles">
							<span class="mitad precio_sin_oferta">S/ {{ $p->precio_unitario }}</span>
							<span class="mitad descuento">-{{ $p->descuento }}% dto.</span>
							{{-- <p class="precio_con_oferta">S/ {{ number_format($p->precio - (($p->precio * $p->descuento) / 100), 2, '.', ',') }}</p> --}}
							<p class="titulo-item-oferta">{{ $p->nombre }}</p>
						</div>
					</a>
					<span class="etiqueta-oferta">-{{ $p->descuento }}%</span>
				@else
					<a href="{{ route('producto', ['id'=>$p->id]) }}">
						<figure>
							<img src="{{ asset('imgProductos_215/' . $p->foto) }}">
						</figure>
						<div class="detalles">
							{{-- <span class="precio_anterior">S/ {{ $p->precio_anterior }}</span> --}}
							<p class="precio_con_oferta">S/ {{ $p->precio_unitario }}</p>
							<p class="title_elemento">{{ $p->nombre }}</p>
						</div>
					</a>
				@endif
			</div>
		</div>
		@endforeach
	</div>
</div>
<div class="row">
	<div class="small-6 small-centered columns">
		{{ $productos->links() }}
	</div>
</div>
@endsection