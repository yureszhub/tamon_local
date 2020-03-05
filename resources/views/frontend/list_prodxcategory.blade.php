@extends('frontend.header')

@section('content')

<div class="small-5 small-centered columns titulo-categoria">
	<h2 class="text-center">{{ $categoria->name }}</h2>
</div>
<div id="section-category" class="large-12 columns">
	<div class="row">
		@foreach($productos as $p)
		<div class="large-3 columns">
			<div class="item-producto">
				<a href="{{ url('/producto', ['id'=>$p->id]) }}">
					{{-- <img src="{{ asset('/imgProductos_400').'/'.$p->foto }}"> --}}
					<figure>
						<img src="{{ asset('/images/img_product_2.jpg') }}">
						@if (!is_null($p->descuento))
							<div class="space-descuento">
								<span class="off_product">{{ $p->descuento }}</span>
								<span class="percent">% descuento</span>
							</div>
						@endif
					</figure>
					<div class="detalles">
						<h2 class="title_product">{{ $p->nombre }}</h2>
						@if (is_null($p->descuento))
							<p class="price-product">S/ {{ $p->precio_unitario }}</p>
						@else
							<p class="price-product-with-offer"><span class="price-old">S/ {{ $p->precio_unitario }}</span><span>S/ 200.00</span></p>
						@endif
					</div>
					<button type="button" class="button button-go-product">Ver Producto</button>
				</a>
			</div>
		</div>
		@endforeach
	</div>
	<div class="row" style="padding: 1.2rem 0;">
		<div class="small-6 small-centered columns">
			{{ $productos->links() }}
		</div>
	</div>
</div>
@endsection