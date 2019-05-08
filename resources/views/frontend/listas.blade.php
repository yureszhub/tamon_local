@extends('frontend.header')

@section('content')	
	<ul class="example-orbit-content" data-orbit data-options="animation:fade;
	pause_on_hover:false;
	timer_speed: 4000;
	animation_speed: 800;
	navigation_arrows:true;
	bullets:false;
	slide_number:false;">
	  <li data-orbit-slide="headline-1" class="orbit-gimnasio">
	  	<img src="images/slider-dos.jpg" alt="slide 1" />
	    <div class="text-slider">
	      <a href="{{ route('categoria', 6) }}" class="button radius">
	      	<h1>Chompas</h1>
	      </a>
	    </div>
	  </li>
	  <li data-orbit-slide="headline-2" class="orbit-edredon">
	  	<img src="images/slider_determinacion.jpg" alt="slide 2" />
	    <div class="text-slider">
	      <a href="{{ route('categoria', 7) }}" class="button alert radius">
	      	<h1>Polos</h1>
    	  </a>
	    </div>
	  </li>
	</ul>
	<div class="large-12 columns anuncio">
		<h2 class="anuncio-liquidacion"><span class="color-white">LIQUIDACIÓN</span> 2019</h2>
	</div>
	{{-- <div class="large-12 columns content-owl-carousel">
		<div class="row-carousel">
			<div class="large-10 large-offset-1 columns">
				<div class="owl-carousel owl-theme slider-carousel" id="slider-carousel-category">
					@foreach($ofertas as $o)
						<div class="item owl-animated-out liquidacion item-carousel">
							<a href="{{ route('producto', ['id'=>$o->id]) }}">
								<figure>
									<img src="{{ url('imgProductos_215/1494380728_guantes.jpg') }}">
								</figure>
								<div class="detalles">
									<span class="mitad precio_sin_oferta">S/ {{ $o->precio }}</span>
									<span class="mitad descuento">-{{ $o->descuento }}% dto.</span>
									<p class="precio_con_oferta">S/ {{ number_format( ($o->precio * 100) / (100 - $o->descuento), 2, '.', ',') }}</p>
								</div>
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
	</div> --}}
	<div class="large-12 columns content-owl-carousel categorias-productos-frontend">
	@foreach ($cate as $ct)
			<div class="row-carousel">
				<div class="large-10 large-offset-1 columns">
					<div class="large-12">
						<strong style="font-size: 2.2em; text-transform: uppercase; margin-right: 15px;">{{ $ct->nom_categoria }}</strong> <a href="{{ url('/categoria', ['id'=>$ct->id]) }}">Ver más</a>
					</div>
					<div class="owl-carousel owl-theme slider-carousel" id="slider-carousel-category">
						@foreach($ct->productos as $p)
							<div class="item owl-animated-out item-carousel">
								<a href="{{ url('/producto', ['id'=>$p->id]) }}">
									<figure>
										<img src="{{ asset('/imgProductos_215/1494380728_guantes.jpg') }}">
									</figure>
									<div class="detalles">
										<p class="precio_con_oferta">S/ {{ $p->precio_unitario }}</p>
										<p class="title_elemento">{{ $p->nombre }}</p>
									</div>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
	@endforeach
		</div>
@endsection