<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;
use App\Oferta;
use App\Oferta_producto;
use Illuminate\Support\Facades\DB;
/* Image es necesario para recordar la imagen subida */
use Image;
/* 
Usamos Storage para poder almacenar las imagenes
del producto en el disco creado en config/filesystems
*/
use Storage;

class OfertaController extends Controller
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
        $ofertas = DB::table('ofertas')->orderBy('id', 'desc')->get();
        
        /*$p_ofertas = Oferta_producto::all();*/
        $p_ofertas = DB::table('oferta_productos')
                    ->leftJoin('productos', 'oferta_productos.producto_id', '=', 'productos.id')
                    ->select('oferta_productos.*', 'productos.nom_producto')
                    ->get();
        
        return view('oferta.list_ofertas', ['ofertas' => $ofertas, 'products' => $p_ofertas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        return view('oferta.createoferta', ['productos' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$long = count($request['mis-productos']);
        dd($request['mis-productos'][0]);*/
        $this->validate($request, [
            'mis-productos' => 'required',
            'img_oferta' => 'required',
        ]);

        $oferta = new Oferta();

        /* agarramos el contenido de la imagen en la variable img */
        $img = $request->file('img_oferta');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('imgProductos')->put($file_route, file_get_contents( $img->getRealPath() ));

        $oferta->nom_oferta = $request->nom_oferta;
        $oferta->img_oferta = $file_route;

        /* metodo dos con interventio image */
        $destinationPath_100 = public_path('imgProductos_100');
        $destinationPath_215 = public_path('imgProductos_215');
        $destinationPath_400 = public_path('imgProductos_400');

        $img_resize_100 = Image::make($img->getRealPath());
        $img_resize_100->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_100.'/'.$file_route);

        $img_resize_215 = Image::make($img->getRealPath());
        $img_resize_215->resize(215, 215, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_215.'/'.$file_route);

        $img_resize_400 = Image::make($img->getRealPath());
        $img_resize_400->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_400.'/'.$file_route);
        /* fin del segundo metodo de image */

        if ($request->descuento == "") 
            $oferta->descuento = 0;
        else 
            $oferta->descuento = $request->descuento;

        if ($request->precio_oferta == "")
            $oferta->precio = 0;
        else
            $oferta->precio = $request->precio_oferta;
        
        if ($oferta->save()) {
            $cod_oferta = $oferta->id;
            $length = count($request['mis-productos']);
            for ($i=0; $i < $length; $i++) { 
                $oferta_producto = new Oferta_producto();
                $oferta_producto->oferta_id = $cod_oferta;
                $oferta_producto->producto_id = $request['mis-productos'][$i];
                $oferta_producto->save();
            }
            return redirect('ofertas')->with('msj', 'Oferta guardada');
        } else {
            return back()->with('error_msj', 'La oferta no se guardo correctamente, vuelva a intentarlo');
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
        $oferta = Oferta::find($id);
        /*$productos = Oferta_producto::where('oferta_id', $id)->get();*/
        $productos = Producto::all();
        $productos_oferta = DB::table('oferta_productos')
                            ->leftJoin('productos', 'oferta_productos.producto_id', '=', 'productos.id')
                            ->where('oferta_productos.oferta_id', $id)
                            ->select('oferta_productos.producto_id')
                            ->get();
        /*$arreglo = $productos_oferta->collapse();*/
        
        /*dd($productos_oferta->contains('producto_id','2'));*/
        return view('oferta.edit_oferta', ['oferta' => $oferta, 'productos' => $productos, 'productos_oferta' => $productos_oferta]);
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
            'mis-productos' => 'required',
        ]);
        $oferta = Oferta::find($id);
        $oferta->nom_oferta = $request->nom_oferta;

        /* agarramos el contenido de la imagen en la variable img */
        /* si el input img_oferta tiene una imagen nueva la cual ha sido cargada */
        if ($request->img_oferta != NULL) {
            $img_nuevo = $request->file('img_oferta');
            $file_route = time().'_'.$img_nuevo->getClientOriginalName();
            Storage::disk('imgProductos')->put($file_route, file_get_contents( $img_nuevo->getRealPath() ));
            Storage::disk('imgProductos')->delete($request->img_actual);
            Storage::disk('imgProductos_100')->delete($request->img_actual);
            Storage::disk('imgProductos_215')->delete($request->img_actual);
            Storage::disk('imgProductos_400')->delete($request->img_actual);
            /* metodo dos con interventio image */
            $destinationPath_100 = public_path('imgProductos_100');
            $destinationPath_215 = public_path('imgProductos_215');
            $destinationPath_400 = public_path('imgProductos_400');

            $img_resize_100 = Image::make($img_nuevo->getRealPath());
            $img_resize_100->resize(100, 100, function ($constraint) {
              $constraint->aspectRatio();
            })->save($destinationPath_100.'/'.$file_route);

            $img_resize_215 = Image::make($img_nuevo->getRealPath());
            $img_resize_215->resize(215, 215, function ($constraint) {
              $constraint->aspectRatio();
            })->save($destinationPath_215.'/'.$file_route);

            $img_resize_400 = Image::make($img_nuevo->getRealPath());
            $img_resize_400->resize(400, 400, function ($constraint) {
              $constraint->aspectRatio();
            })->save($destinationPath_400.'/'.$file_route);

            /* fin del segundo metodo de image */
            $oferta->img_oferta= $file_route;
        }
        if ($request->descuento == "") 
            $oferta->descuento = "0";
        else 
            $oferta->descuento = $request->descuento;

        if ($request->precio_oferta == "")
            $oferta->precio = "0";
        else
            $oferta->precio = $request->precio_oferta;

        $remove_oferta_productos = Oferta_producto::where('oferta_id', $id)->delete();
        if ($oferta->save()) {
            $cod_oferta = $oferta->id;
            $length = count($request['mis-productos']);
            for ($i=0; $i < $length; $i++) { 
                $oferta_producto = new Oferta_producto();
                $oferta_producto->oferta_id = $cod_oferta;
                $oferta_producto->producto_id = $request['mis-productos'][$i];
                $oferta_producto->save();
            }
            return redirect('ofertas')->with('msj', 'Oferta guardada');
        } else {
            return back()->with('error_msj', 'La oferta no se guardo correctamente, vuelva a intentarlo');
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
        $remove_oferta_productos = Oferta_producto::where('oferta_id', $id)->delete();
        $oferta = Oferta::find($id);
        $url = $oferta->img_oferta;
        Storage::disk('imgProductos')->delete($url);
        Storage::disk('imgProductos_100')->delete($url);
        Storage::disk('imgProductos_215')->delete($url);
        Storage::disk('imgProductos_400')->delete($url);
        Oferta::destroy($id);
        return back();
    }
}
