<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* uso de modelos */
use App\Categoria;
use App\Producto;

class Categorias extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lista todas las categorias
        $categorias = Categoria::all();
        return view('categoria.list-category', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.formcategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->nom_categoria);
        $this->validate($request, [
            'nom_categoria' => 'required',
            'desc_categoria' => 'required'
        ]);

        $categoria = new Categoria();
        $categoria->nom_categoria = $request->nom_categoria;
        $categoria->desc_categoria = $request->desc_categoria;

        if ($categoria->save()) {
            return back()->with('msj', 'Categoria guardada');
        } else {
            return back()->with('error_msj', 'Los datos no se guardaron');
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
        $categoria = Categoria::find($id);
        return view('categoria.edit-categoria')->with(['categoria' => $categoria]);
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
            'nom_categoria' => 'required',
            'desc_categoria' => 'required'
        ]);

        $categoria = Categoria::find($id);
        $categoria->nom_categoria = $request->nom_categoria;
        $categoria->desc_categoria = $request->desc_categoria;

        if ($categoria->save()) {
            return redirect('categorias');
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
        Producto::where('categoria_id', $id)->update(['categoria_id' => 1]);
        Categoria::destroy($id);
        return back();
    }
}
