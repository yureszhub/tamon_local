$(document).ready(function(){
	var suma = 0;
	$('#mis-productos').multiSelect();

	$('#ms-mis-productos .ms-selection').append('<input class="suma_lista" type="text" name="suma_lista_precios">');

	$('.ms-list li.ms-elem-selection').each(function() {
		if ($(this).hasClass("ms-selected")) {
			suma = (parseFloat(suma) + parseFloat($(this).data('precio')));
		}
		$('.suma_lista').val("Suma de Costos: S/ " + suma.toFixed(2));
		$('.input_precioNormal').val(suma.toFixed(2));
	});

	$('ul.ms-list').click(function() {
		var suma_precios = 0;
		$('.ms-list li.ms-elem-selection').each(function() {
			if ($(this).hasClass("ms-selected")) {
				suma_precios = (parseFloat(suma_precios) + parseFloat($(this).data('precio')));
			}
		});
		$('.input_precioNormal').val(suma_precios.toFixed(2));
		$('.suma_oferta').val(suma_precios.toFixed(2));
		var texto = "Suma de Costos: S/ " + suma_precios.toFixed(2);
		$('.suma_lista').val(texto);
		$('.calculo_descuento').val('0');
	});

	$('.suma_oferta').change(function() {
		var x = parseFloat($(this).val());
		var cien = parseFloat($('.input_precioNormal').val());
		if ( x != cien ) { 
			y = (x * 100) / cien;
		}
		var descuento = 100 - parseFloat(y);
		$('.calculo_descuento').val(descuento.toFixed(2));
	});

	$('.calculo_descuento').change(function() {
		var x = parseFloat($('.input_precioNormal').val());
		var porciento = parseFloat($(this).val());
		y = (x * porciento) / 100;
		var nuevo_precio = x - parseFloat(y);
		$('.suma_oferta').val(nuevo_precio.toFixed(2));
	});
});