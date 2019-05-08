<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function correoContacto(Request $request) {
    	$nombre = $request->contacto_nombres;
    	$email = $request->contacto_email;
    	$telefono = $request->contacto_telefono;
    	$descripcion = $request->contacto_mensaje;
    	return "prueba de mensaje enviado";
    }

    public function contact_personal(Request $request) {
    	$this->validate($request, [
            'contacto_nombres' => 'required',
            'contacto_email' => 'required',
            'contacto_mensaje' => 'required'
        	],
        	[
        	'contacto_nombres.required' => 'El campo Nombre es requerido',
        	'contacto_email.required' => 'El campo Correo es requerido',
        	'contacto_mensaje.required' => 'El campo Mensaje es requerido'
        	]
        );
    	$nombre = $request->contacto_nombres;
    	$email = $request->contacto_email;
    	$telefono = $request->contacto_telefono;
    	$descrip_mensaje = $request->contacto_mensaje;
    	
    	$mensaje = "";
    	$mensaje .= "<h2>Contacto Persona natural en Next</h2>";
    	$mensaje .= "<strong>Nombre: </strong>". $nombre . "<br>";
    	$mensaje .= "<strong>Correo Electronico: </strong>". $email . "<br>";
    	$mensaje .= "<strong>Teléfono: </strong>". $telefono . "<br>";
    	$mensaje .= "<strong>Descripcion del mensaje: </strong>". $descrip_mensaje . "<br>";
    	$mensaje = stripcslashes($mensaje);

		$email_to = "yfhq.12@gmail.com";
		$email_titulo = "Contacto Persona Natural en Next";
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		$headers .= "From: $email\r\n";

		$bool = mail($email_to,$email_titulo,utf8_decode($mensaje),$headers);

		if($bool){
		    return "Mensaje enviado";
		}else{
		    return "Mensaje no enviado";
		}
    }

    public function contact_corporativo(Request $request) {

    }
}