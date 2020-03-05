@extends('frontend.header')

@section('content')	
	<ul class="example-orbit-content" data-orbit data-options="animation:fade;
	pause_on_hover:false;
	timer_speed: 4000;
	animation_speed: 800;
	navigation_arrows:true;
	bullets:false;
	slide_number:false;">
		@foreach ($cate as $ct)

		<li data-orbit-slide="headline-1" class="orbit-gimnasio">
			<img src="images/alpaca_1.jpg" alt="slide 1" />
			<div class="text-slider">
			  	<a href="{{ route('categoria', $ct->slug) }}" class="button radius">
				  	<h1>{{ $ct->name }}</h1>
			  	</a>
			</div>
		</li>
		@endforeach
	</ul>

	@if (count($ofertas) > 0)
		<div class="large-12 columns content-owl-carousel section-slider-ofertas-homepage" style="background-color: lightgreen; padding-bottom: 1.5rem;">
			<div class="row">
				<div class="large-12 columns">
					<h2 class="text-center">PRODUCTOS EN OFERTA</h2>
					<div class="owl-carousel owl-theme slider-ofertas-home">
						@foreach($ofertas as $o)
							<div class="item owl-animated-out item-carousel item-producto">
								<a href="{{ url('/producto', ['id'=>$o->id]) }}">
									<figure>
										<img src="{{ asset('/images/img_product_2.jpg') }}">
										@if (!is_null($o->descuento))
											<div class="space-descuento">
												<span class="off_product">{{ $o->descuento }}</span>
												<span class="percent">% descuento</span>
											</div>
										@endif
									</figure>
									<div class="detalles">
										<h2 class="title_product">{{ $o->nombre }}</h2>
										@if (is_null($o->descuento))
											<p class="price-product">S/ {{ $o->precio_unitario }}</p>
										@else
											<p class="price-product-with-offer"><span class="price-old">S/ {{ $o->precio_unitario }}</span><span>S/ {{ $o->precio_unitario - ($o->precio_unitario * ($o->descuento/100)) }}</span></p>
										@endif
									</div>
									<button type="button" class="button button-go-product">Ver Oferta</button>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endif

	<div class="large-12 columns content-owl-carousel categorias-productos-frontend">
		<div class="row">
		@foreach ($cate as $ct)
			<div class="row-carousel">
				<div class="large-12 columns" style="padding-top: .6rem; padding-bottom: .6rem;">
					<div style="margin-bottom: .4rem;">
						<h2 style="font-size: 1.6rem; margin-right: 5px; display: inline;">{{ $ct->name }}</h2> <a href="{{ url('/categoria', ['slug'=>$ct->slug]) }}" class="ver-mas">Ver más</a>
					</div>
					<div class="owl-carousel owl-theme slider-category-home">
						@foreach($ct->productos as $p)
							<div class="item owl-animated-out item-carousel item-producto">
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
											<p class="price-product-with-offer"><span class="price-old">S/ {{ $p->precio_unitario }}</span><span>S/ {{  $p->precio_unitario - ($p->precio_unitario * ($p->descuento/100))  }}</span></p>
										@endif
									</div>
									<button type="button" class="button button-go-product">Ver Producto</button>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>
@endsection