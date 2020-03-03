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
	<div class="large-12 columns content-owl-carousel">
		<div class="row-carousel">
			<div class="large-10 large-offset-1 columns">
				<h2 class="text-center">OFERTAS 2020</h2>
				<div class="owl-carousel owl-theme slider-ofertas-home" id="slider-carousel-category">
					@foreach($ofertas as $o)
						<div class="item owl-animated-out liquidacion item-carousel">
							<a href="{{ route('producto', ['id'=>$o->id]) }}">
								<figure>
									{{-- <img src="{{ asset('/imgProductos_215').'/'.$o->foto }}"> --}}
									<img src="{{ asset('/images/img_product.jpg') }}">
								</figure>
								<div class="detalles">
									<p class="title_elemento">{{ $o->nombre }}</p>
									<p style="font-size: 11px; color: #666">Antes S/ {{ $o->precio }}</p>
									<p class="precio_con_oferta">S/ {{ number_format( ($o->precio) - ($o->precio * ($o->descuento / 100)), 2, '.', ',') }}</p>
								</div>
								<button class="button warning">Ver Oferta</button>
							</a>
							@if($o->descuento != 0)
								<span class="etiqueta-oferta">-{{ $o->descuento }}%</span>
							@else
								<span class="etiqueta-oferta">Oferta</span>
							@endif
						</div><!-- item owl-animated-out liquidacion -->
					@endforeach
				</div>
			</div>
		</div>
	</div>
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
											<p class="price-product-with-offer"><span class="price-old">S/ {{ $p->precio_unitario }}</span><span>S/ 200.00</span></p>
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