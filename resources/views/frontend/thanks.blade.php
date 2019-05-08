@extends('frontend.header')

@section('content')	
<div class="large-12 columns">
	<div class="large-6 columns">
		<h1>Gracias por confiar en nosotros</h1>
		<p>En pocos minutos estaremos en contacto con usted para concretar de mejor manera vuestra solicitud.</p>
		<!-- <form role="form" method="POST" action="{{ url('imprimir_pdf') }}">
          	{{ csrf_field() }}
			<input type="hidden" name="codigos" value="{{ $codigos }}">
			<button>Download PDF</button>
		</form> -->
	</div>
	<div class="large-6 columns">
		<h1>NEXT</h1>
	</div>
</div>
@endsection