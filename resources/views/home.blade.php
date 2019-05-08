@extends('admin.header')

@section('content')
<div class="large-10 large-offset-1 columns dashboard-content">
	<h1 style="text-align: center;">Dashboard NEXT</h1>
	<div class="row access_dashboard">
		<div class="small-12 large-4 columns">
			<a href="{{ url('productos') }}">
				<h2>Productos</h2>
				<figure>
					<img src="images/product.png" />
				</figure>
			</a>
		</div>
		<div class="small-12 large-4 columns">
			<a href="{{ url('ofertas') }}">
				<h2>Ofertas</h2>
				<figure>
					<img src="images/offer.png" />
				</figure>
			</a>
		</div>
		<div class="small-12 large-4 columns">
			<a href="{{ url('categorias') }}">
				<h2>Categorias</h2>
				<figure>
					<img src="images/category.png" />
				</figure>
			</a>
		</div>
	</div>
</div>
@endsection
