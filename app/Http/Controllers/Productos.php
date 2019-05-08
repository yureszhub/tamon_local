<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* para la ventana de confirmacion en el metodo destroy */
/*use Illuminate\Support\Facades\Session;*/

/* uso de modelos */
use App\Categoria;
use App\Producto;

use Illuminate\Support\Facades\DB;

use Image;

/*use Intervention\Image\ImageManager as Image;*/

/* 
Usamos Storage para poder almacenar las imagenes
del producto en el disco creado en config/filesystems
*/
use Storage;

class Productos extends Controller
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
    public function index(Request $request) {
      /*$categorias = Categoria::all();
      $admin = "yuresz";
      $edades = [12, 13, 14, 15];
      $data = array('categorias' => $categorias,
                  'nombre' => $admin,
                  'edades' => $edades );
      return view('pages.contact')->with($data);*/

      /* retornamos la lista de productos */

      $productos = Producto::name($request->get('name'))
                          ->orderBy('id', 'desc')
                          ->paginate();
      $categorias = DB::table('categorias')
                    ->select('id', 'nom_categoria')
                    ->get();
      /*$productos = DB::table('productos')
                      ->orderBy('id', 'desc')
                      ->paginate(8);*/
      return view('producto.list-producto', ['productos' => $productos, 'categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categorias = Categoria::select('id', 'nom_categoria')->get();
      return view('producto.formproducto', ['categorias' => $categorias]);
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
          'nom_producto' => 'required',
          'desc_producto' => 'required',
          'img_producto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
          'precio' => 'required',
          'categoria_id' => 'required'
          ]);

      $producto = new Producto();
      $producto->nom_producto = $request->nom_producto;
      $producto->desc_producto = $request->desc_producto;

      /* agarramos el contenido de la imagen en la variable img */
      $img = $request->file('img_producto');
      $file_route = time().'_'.$img->getClientOriginalName();
      Storage::disk('imgProductos')->put($file_route, file_get_contents( $img->getRealPath() ));

      $producto->img_producto= $file_route;

      /* resize image */
      /*$path = public_path('imgProductos/'.$file_route);
      $arreglo = explode(".", $file_route);
      $titulo_nueva_imagen = $arreglo[0] . "_300x300." . $arreglo[1];
      $path2 = public_path('imgProductos/'.$titulo_nueva_imagen);
      $imagen_dos = new Imagick($path);
      $imagen_dos->cropThumbnailImage(300,300);
      $imagen_dos->writeImage($path2);*/
      //dd($path, $file_route, $arreglo[0], $arreglo[1], $titulo_nueva_imagen, $path2);
      /* end resize image */

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

      $producto->precio = $request->precio;
      if ($request->precio_anterior == "") {
        $producto->precio_anterior = "0";
      } else {
        $producto->precio_anterior = $request->precio_anterior;  
      }
      $producto->categoria_id = $request->categoria_id;

      if ($producto->save()) {
          return back()->with('msj', 'Producto guardado');    
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
      $categorias = Categoria::select('id', 'nom_categoria')->get();
      $producto = Producto::find($id);
      return view('producto.edit-producto')->with(['edit' => true, 
                                                  'producto' => $producto,
                                                  'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      $this->validate($request, [
          'nom_producto' => 'required',
          'desc_producto' => 'required',
          'precio' => 'required',
          'categoria_id' => 'required'
          ]);

      $producto = Producto::find($id);
      $producto->nom_producto = $request->nom_producto;
      $producto->desc_producto = $request->desc_producto;

      /* agarramos el contenido de la imagen en la variable img */
      /* si el input img_producto tiene una imagen nueva la cual ha sido cargada */
      if ($request->img_producto != NULL) {
        $img_nuevo = $request->file('img_producto');
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

        $producto->img_producto= $file_route;
      }
      if ($request->precio_anterior == "") {
        $producto->precio_anterior = "0";
      } else {
        $producto->precio_anterior = $request->precio_anterior;  
      }
      $producto->precio = $request->precio;
      $producto->categoria_id = $request->categoria_id;

      if ($producto->save()) {
        return redirect('productos');  
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
    public function destroy($id) {
      $producto = Producto::find($id);
      $url = $producto->img_producto;
      Storage::disk('imgProductos')->delete($url);
      Storage::disk('imgProductos_100')->delete($url);
      Storage::disk('imgProductos_215')->delete($url);
      Storage::disk('imgProductos_400')->delete($url);
      Producto::destroy($id);
      return back();
    }
}
