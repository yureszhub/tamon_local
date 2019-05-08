<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* uso de modelos */
use App\OfertaDia;
use App\Producto;

/* libreria para hacer consultas DB */
use Illuminate\Support\Facades\DB;

class OfertasDia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        $ofertas = DB::table('oferta_dias')
                    ->leftJoin('productos', 'oferta_dias.producto_id', '=', 'productos.id')
                    ->select('oferta_dias.*', 'productos.nom_producto', 'productos.img_producto', 'productos.precio')
                    ->orderBy('id', 'desc')
                    ->get();

        return view('ofertasDia.list-oferta', ['ofertas' => $ofertas, 'productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();

        return view('ofertasDia.formoferta', ['productos' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'producto_id' => 'required',
          'descuento' => 'required',
          ]);
        $oferta = new OfertaDia();
        $oferta->producto_id = $request->producto_id;
        $oferta->descuento = $request->descuento;

        if ($oferta->save()) {
            return redirect('ofertas')->with('msj', 'Oferta guardada');
          /*return back()->with('msj', 'Oferta guardada');    */
        } else {
          return back()->with('error_msj', 'La oferta no se guardo correctamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oferta = DB::table('oferta_dias')
                    ->leftJoin('productos', 'oferta_dias.producto_id', '=', 'productos.id')
                    ->select('oferta_dias.*', 'productos.nom_producto')
                    ->where('oferta_dias.id', $id)
                    ->get();
        return view('ofertasDia.edit_oferta')->with(['oferta' => $oferta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'descuento' => 'required'
        ]);

        $oferta = OfertaDia::find($id);
        $oferta->descuento = $request->descuento;

        if ($oferta->save()) {
            return redirect('ofertas');
        } else {
            return back()->with('error_msj', 'Los datos no se guardaron');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OfertaDia::destroy($id);
        return back();
    }
}
