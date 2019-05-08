<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/****************** BACKEND ******************/
	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	/// Rutas para Categoria
	Route::resource('categorias', 'Categorias');

	/// Rutas para Productos
	Route::resource('productos', 'Productos');

	/// Rutas para las Ofertas del dia en el BackEnd
	/*Route::resource('ofertas', 'OfertasDia');*/
	Route::resource('ofertas', 'OfertaController');

/****************** END BACKEND ******************/

/***************** FRONTEND *******************/
	Route::get('/', 'Frontend@index')->name('next');

	Route::get('/get-categories', 'Frontend@getCategories');

	Route::get('/categoria/{id}', ['uses' => 'Frontend@productosXcategoria',
									'as' => 'categoria']);

	Route::get('/producto/{id}', ['uses' => 'Frontend@showProducto',
									'as' => 'producto']);

	Route::get('/oferta/{id}', ['uses' => 'Frontend@showOferta',
									'as' => 'detalle-oferta']);

	/* Rutas paginas estaticas */
	Route::post('/newsletter', 'NewsletterController@recibirCorreo')->name('newsletter');

	Route::get('/contacto-personal', function() {
		return view('pages.contact-personal');
	})->name('contacto-personal');

	Route::get('/contacto-corporativo', function() {
		return view('pages.contact-corporativo');
	})->name('contacto-corporativo');

	Route::get('/quienes-somos', function() {
		return view('pages.quienes-somos');
	})->name('quienes-somos');

	Route::get('/mision', function() {
		return view('pages.mision');
	})->name('mision');

	Route::get('/vision', function() {
		return view('pages.vision');
	})->name('vision');
	/* Fin rutas paginas estaticas */

	Route::post('/send-email-personal', 'CorreoController@contact_personal');

	Route::post('/send-email-corporativo', 'CorreoController@contact_corporativo');

	Route::post('/enviar-cotizacion', [
		'uses' => 'CotizacionController@recibirCotizacion',
	]);

	Route::post('/imprimir_pdf', 'CotizacionController@imprimir')->name('imprimir_pdf');

	/*Route::get('/pdf-cotizacion/{car}', 'CotizacionController@imprimir_pdf')->name('pdf-cotizacion');*/

	/*
	Shopping Cart
	*/
	Route::get('/agregar-al-carrito/{tipo}/{id}', [
		'uses' => 'Frontend@getAddToCart',
		'as' => 'producto.agregar_al_carrito'
	]);

	Route::get('/carrito-de-compras', [
		'uses' => 'Frontend@getCart',
		'as' => 'producto.carrito_de_compras'
	]);

	/* para actualizar la cantidad en la sesion de carrito de compras */
	Route::get('/change-qty/{id}/{cant}', [
		'uses' => 'Frontend@getChangeQty',
		'as' => 'producto.changeQty'
	]);

/****************** END FRONTEND ******************/