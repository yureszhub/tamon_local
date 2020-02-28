$(document).ready(function(){
	/*$('.owl-carousel').owlCarousel({
	    loop:true,
	    center:true,
	    smartSpeed:1500,
	    mouseDrag:false,
	    navText:["<span><</span>","<span>></span>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true,
	            loop:true
	        },
	        600:{
	            items:3,
	            nav:true,
	            loop:true
	        },
	        1000:{
	            items:5,
	            nav:true,
	            loop:true
	        }
	    }
	});*/
	$('.slider-category-home').owlCarousel({
	    loop:true,
	    margin:15,
	    center:true,
	    smartSpeed:1500,
	    mouseDrag:true,
	    dots:false,
	    navText:["<span><</span>","<span>></span>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true,
	            loop:true
	        },
	        600:{
	            items:3,
	            nav:true,
	            loop:true
	        },
	        1000:{
	            items:5,
	            nav:true,
	            loop:true
	        }
	    }
	});
	$('.slider-ofertas-home').owlCarousel({
	    loop:true,
	    margin: 15,
	    center:true,
	    smartSpeed:1500,
	    mouseDrag:false,
	    navText:["<span><</span>","<span>></span>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true,
	            loop:true
	        },
	        600:{
	            items:3,
	            nav:true,
	            loop:true
	        },
	        1000:{
	            items:5,
	            nav:true,
	            loop:true
	        }
	    }
	});
	$('.prod_cant').change(function() {
		if ($(this).val() == "") {
			alert("Cantidad tiene que ser un numero positivo");
		} else {
			var cod_producto = $(this).data('codigo');
			var new_cant = $(this).val();
			var url = "change-qty/"+cod_producto+"/"+new_cant;
			$(location).attr('href',url);
		}
	});

	$('.bajar-a-cero').click(function() {
		var cod_item = $(this).data('codigoitem');
		var cantidad = 0;
		var url = "change-qty/"+cod_item+"/"+cantidad;
		$(location).attr('href',url);
	});
	
	$("#zoom_01").elevateZoom({
		zoomWindowPosition: 1, 
		zoomWindowOffetx: 20
		/*zoomType: "inner",
		cursor: "crosshair"*/
	});

	/* elevate zoom para las ofertas */
	/*$("#img_01").elevateZoom({
		zoomWindowPosition: 1, 
		zoomWindowOffetx: 20
	});*/

	$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://tiendasnext.local/images/spinner.gif', zoomWindowOffetx: 20,}); 

	$("#img_01").bind("click", function(e) {  
	  var ez =   $('#img_01').data('elevateZoom');	
		$.fancybox(ez.getGalleryList());
	  return false;
	});
	/* fin elevate zoom para las ofertas */
});

/*$(window).load(function() {
	var altura = $('#slider-carousel-category .owl-stage-outer').height();
	$('.button-nav').css({ height: altura });
	$('#slider-carousel-category .owl-prev').clone().appendTo('.button-nav-i');
});*/