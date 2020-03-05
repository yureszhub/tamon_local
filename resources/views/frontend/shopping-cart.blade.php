@extends('frontend.header')

@section('content')
<div class="row" style="padding: 1.5rem 0rem 2rem">
	<div class="large-12 columns content-producto">
	<h4 style="text-align: center;">BOLSA DE COMPRAS</h4>
	@if( Session::has('cart') && Session::get('cart')['totalQty'] > 0 )
		<div class="small-12 large-8 columns">
			<ul class="no-bullet">
				@foreach($productos as $p)
					<?php 
						$url_img = $p['item']->img_producto;
						$nombre = $p['item']->nom_producto;
					?>
					<li class="large-12 columns list-shopping">
						<div class="small-12 medium-3 large-4 columns list-img">
							<figure>
								<img id="img_zoom" src="{{ url('imgProductos_215/' . $url_img) }}">
							</figure>
						</div>
						<div class="small-12 medium-9 large-8 columns list-descripcion">
							<h5 class="cart-title-producto">{{ $nombre }}</h5>
							<div class="small-12 medium-4 large-4 columns list-descripcion-precios">
								<label>Precio Unitario:
									<input class="input-p-unitario" type="text" name="precio_unitario" value="S/ {{ number_format($p['item']->precio, 2, '.', ',') }}" readonly>
								</label>
							</div>
							<div class="small-6 medium-3 large-3 columns">
							  <label>Cantidad:
							    <input class="prod_cant" type="number" placeholder="Cantidad" value="{{ $p['qty'] }}" data-codigo="{{ $p['codigo_item'] }}" min="0" />
							  </label>
							</div>
							<div class="small-6 medium-4 large-4 columns">
							  <label>Importe:
							    <input type="text" placeholder="Importe" value="{{ number_format($p['price'], 2, '.', ',') }}" readonly />
							  </label>
							</div>
							<div class="small-12 medium-1 large-1 columns div-content-button-remove">
								<button class="bajar-a-cero button alert tiny" data-codigoitem="{{ $p['codigo_item'] }}"><i class="fa fa-times fa-2x" aria-hidden="true"></i></button>
							</div>
						</div>
					</li>
				@endforeach
				<li class="large-12 columns list-shopping">
					<div class="small-12 columns end text-right">
						<span><strong>SubTotal ({{ Session::get('cart')['totalQty'] }} items): </strong></span><span class="color-rojo">S/ {{ number_format(Session::get('cart')['totalPrice'], 2, '.', ',') }}</span>
					</div>
				</li>
			</ul>
		</div>
		<div class="small-12 large-4 columns resumen-cotizacion">
			<h4>Resumen de tu Cotización</h4>
			<div style="border-bottom: 1px solid #eee; margin-bottom: 10px; padding-bottom: 8px;">
				<span><strong>SubTotal ({{ Session::get('cart')['totalQty'] }} items): </strong></span><span class="color-rojo">S/ {{ number_format(Session::get('cart')['totalPrice'], 2, '.', ',') }}</span>
			</div>
			<div class="form-cotizacion">
				<span>Para solicitar mas información y determinar el modo de envio es necesario llenar el siguiente formulario</span>
				<form role="form" method="POST" action="{{ url('enviar-cotizacion') }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="large-12 columns">
						  	<label>Nombre completo (campo requerido)
						    	<input type="text" name="nombre_cotizacion"/>
						  	</label>
						  	@if($errors->has('nombre_cotizacion'))
							  <small class="error">{{ $errors->first('nombre_cotizacion') }}</small>
						  	@endif
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
						  	<label>Correo electrónico (campo requerido)
						    	<input type="email" name="correo_cotizacion"/>
						  	</label>
						  	@if($errors->has('correo_cotizacion'))
							  <small class="error">{{ $errors->first('correo_cotizacion') }}</small>
						  	@endif
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
						  	<label>Teléfono
						    	<input type="tel" name="telefono_cotizacion"/>
						  	</label>
						</div>
					</div>
					<div class="row">
					  <div class="large-12 columns">
					    <button type="submit" class="button medium"><i class="fa fa-check-square-o" aria-hidden="true"></i> Solicitar Cotización</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	@else
		<div class="row" style="text-align: center;">
			<img src="{{ url('images/sin_compras.jpg') }}">
			<h4>No tienes productos en tu bolsa</h4>	
			<a href="{{ route('next') }}" class="button alert">COMPRAR AHORA</a>
		</div>
	@endif
	</div>
</div>
@endsection