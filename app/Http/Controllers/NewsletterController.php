<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suscriptores;

class NewsletterController extends Controller
{
    public function recibirCorreo(Request $request) {
    	$this->validate($request, [
    		'correo' => 'required',
			],
			[
			'correo.required' => 'Necesita ingresar un correo valido para suscribirse'
			]
		);
		
    	$suscriptor = new Suscriptores();
    	$suscriptor->correo = $request->correo;
    	if ($suscriptor->save()) {
    		return back()->with('msj', 'Correo añadido a suscriptores');
    	} else {
    		return back()->with('error_msj', 'Ocurrio un error');
    	}
    }
}
