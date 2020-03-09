<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Mail\sendMailCotizacion;

class CotizacionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function recibirCotizacion(Request $request)
    {
        //dd($request, $request->nombre_cotizacion);
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
        esta lista tiene que ser enviada al correo de la tienda
        */
        $codigos = "";
        $lista = "<table><thead><tr><th style='border: 1px solid #444;'>Cantidad</th><th style='border: 1px solid #444;'>Cod. Producto</th><th style='border: 1px solid #444;'>Produto</th><th style='border: 1px solid #444;'>Precio Venta</th></tr></thead>";
        $lista .= "<tbody>";

        foreach ($oldCart['items'] as $objeto) {
            $codigos .= $objeto['codigo_item'] . ",";
            $lista .= "<tr>";
            $lista .= "<td style='border: 1px solid #444;'>".$objeto['qty']. "</td>";
            $lista .= "<td style='border: 1px solid #444;'>".$objeto['item']->cod_producto. "</td>";
            $lista .= "<td style='border: 1px solid #444;'>".$objeto['item']->nom_producto. "</td>";
            $lista .= "<td style='text-align:right;border: 1px solid #444;'>S/ ".$objeto['price']. "</td>";
            $lista .= "</tr>";
        }
        $lista .= "</tbody></table>";
        $codigos = trim($codigos, ',');

        $data_cotizacion = [
            'lista' => $lista,
            'nombre_solicitante' => $nombre_solicitante,
            'correo_solicitante' => $correo_solicitante,
            'tel_solicitante' => $tel_solicitante,
        ];
        
        \Mail::to('yuresz.vp@gmail.com')->send(new sendMailCotizacion($data_cotizacion));

        return view('frontend.thanks', ['nombre' => $nombre_solicitante, 'correo' => $correo_solicitante, 'codigos' => $codigos]);
    }

    public function imprimir(Request $request) {
        echo("voy a imprimir");
        $producto = explode(",", $request->codigos);
        dd($producto);
    }
}