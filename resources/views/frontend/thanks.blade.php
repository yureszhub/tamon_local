@extends('frontend.header')

@section('content')	
<div class="row">
	<div class="large-12 columns text-center">
		<h1>Gracias por confiar en nosotros</h1>
		<p>En pocos minutos estaremos en contacto con usted en respuesta a su solicitud.</p>
		<h1>ALPACA TAMON</h1>
		{{-- <form role="form" method="POST" action="{{ url('imprimir_pdf') }}">
          	{{ csrf_field() }}
			<input type="hidden" name="codigos" value="{{ $codigos }}">
			<button>Download PDF</button>
		</form> --}}
	</div>
</div>
@endsection