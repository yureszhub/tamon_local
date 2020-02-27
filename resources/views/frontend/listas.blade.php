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
	<div class="large-12 columns anuncio">
		<h2 class="anuncio-liquidacion"><span class="color-white">PRODUCTOS EN OFERTA</span> 2020</h2>
	</div>
	<div class="large-12 columns content-owl-carousel" style="background-color: rgb(151, 249, 177)">
		<div class="row-carousel">
			<div class="large-10 large-offset-1 columns">
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
								<button class="button expand success">Ver Oferta</button>
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
	<div class="large-12 columns content-owl-carousel categorias-productos-frontend" style="background-color: #f5f5f5">
	@foreach ($cate as $ct)
			<div class="row-carousel">
				<div class="large-10 large-offset-1 columns">
					<div class="large-12">
						<strong style="font-size: 2.2em; text-transform: uppercase; margin-right: 15px;">{{ $ct->name }}</strong> <a href="{{ url('/categoria', ['slug'=>$ct->slug]) }}">Ver más</a>
					</div>
					<div class="owl-carousel owl-theme slider-category-home" id="slider-carousel-category">
						@foreach($ct->productos as $p)
							<div class="item owl-animated-out item-carousel">
								<a href="{{ url('/producto', ['id'=>$p->id]) }}">
									<figure>
										{{-- <img src="{{ asset('/imgProductos_215').'/'.$p->foto }}"> --}}
										<img src="{{ asset('/images/img_product.jpg') }}">
									</figure>
									<div class="detalles">
										<p class="title_elemento">{{ $p->nombre }}</p>
										<p class="precio">S/ {{ $p->precio_unitario }}</p>
									</div>
									<button type="button" class="button expand success bg-orange">Ver Producto</button>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
	@endforeach
	</div>
@endsection