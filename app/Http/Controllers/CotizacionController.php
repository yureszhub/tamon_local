<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class CotizacionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function recibirCotizacion(Request $request)
    {
        if (!Session::has('cart')) {
          return redirect()->route('next');
        }

        $this->validate($request, [
            'nombre_cotizacion' => 'required',
            'correo_cotizacion' => 'required'
            ],
            [
            'nombre_cotizacion.required' => 'El campo Nombre es requerido',
            'correo_cotizacion.required' => 'El campo Correo es requerido'
            ]
        );
        $nombre_solicitante = $request->nombre_cotizacion;
        $correo_solicitante = $request->correo_cotizacion;
        $tel_solicitante = $request->telefono_cotizacion;

        /*if ($request->download_pdf == 'si') {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML('<h1>Todo en la vida se puede</h1>');
            $pdf->download('cotizacion.pdf');
        }*/

        $oldCart = Session::get('cart');
        Session::forget('cart'); // eliminamos de session el carrito de compras
        /* 
        $lista -> lista de los productos seleccionados en el carrito de compras,
        esta lista tiene que ser enviada al correo de next
        */
        $codigos = "";
        $lista = "<ul>";

        foreach ($oldCart['items'] as $objeto) {
            $codigos .= $objeto['codigo_item'] . ",";
            $lista .= "<li>" . $objeto['codigo_item']. " - " . $objeto['item']->nom_producto. "</li>";
        }
        $lista .= "</ul>";
        $codigos = trim($codigos, ',');
        return view('frontend.thanks', ['nombre' => $nombre_solicitante, 'correo' => $correo_solicitante, 'codigos' => $codigos]);
    }

    public function imprimir(Request $request) {
        echo("voy a imprimir");
        $producto = explode(",", $request->codigos);
        dd($producto);
    }
}