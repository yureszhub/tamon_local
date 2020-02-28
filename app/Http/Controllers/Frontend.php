<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* llamado de modelos */
use App\Producto;
use App\Categoria;
use App\OfertaDia;
use App\Oferta;

use App\Cart;
use Session;

use Illuminate\Support\Facades\DB;

class Frontend extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $categorias = DB::table('categories')
      ->where('id', '!=', 1)
      ->select('id', 'name', 'slug')
      ->get();

    foreach ($categorias as $cat) {
      $cat->productos = DB::table('familia_producto')->where('categoria__id', $cat->id)->take(6)->get();
    }

    $ofertas = DB::table('ofertas')
      ->leftJoin('familia_producto', 'ofertas.cod_producto', '=', 'familia_producto.cod_producto')
      ->select('ofertas.*', 'familia_producto.id', 'familia_producto.precio_unitario as precio', 'familia_producto.foto', 'familia_producto.nombre')
      ->take(5)
      ->get();

    return view('frontend.listas', ['cate' => $categorias, 'ofertas' => $ofertas]);
  }

  public function productosXcategoria($slug) {
      $categoria = DB::table('categories')->where('slug', $slug)->first();
      if (!is_null($categoria)) {
        $productos = DB::table('familia_producto')
                    ->where('familia_producto.categoria__id', $categoria->id)
                    ->leftJoin('ofertas', 'familia_producto.cod_producto', '=', 'ofertas.cod_producto')
                    ->orderBy('familia_producto.id', 'desc')
                    ->select('familia_producto.id', 'familia_producto.cod_producto', 'familia_producto.nombre', 'familia_producto.descripcion', 'familia_producto.precio_unitario', 'familia_producto.foto', 'ofertas.descuento')
                    ->paginate(16);

        return view('frontend.list_prodxcategory', ['productos' => $productos, 'categoria' => $categoria]);
      } else {
        return redirect('/');
      }
    
  }

  public function showProducto($id_producto) {
      /*$producto = DB::table('productos')
                  ->leftJoin('oferta_dias', 'productos.id', '=', 'oferta_dias.producto_id')
                  ->where('productos.id', $id_producto)
                  ->select('productos.*', 'oferta_dias.descuento')
                  ->get();*/
                  
      $producto = DB::table('familia_producto')
        ->where('id', $id_producto)
        ->select('familia_producto.id', 'familia_producto.precio_unitario', 'familia_producto.nombre', 'familia_producto.descripcion', 'familia_producto.foto')
        ->get();

      return view('frontend.show_producto', ['producto' => $producto]);
  }

  public function showOferta($id_oferta) {
    $oferta = Oferta::find($id_oferta);
    $productos_oferta = DB::table('oferta_productos')
                            ->leftJoin('productos', 'oferta_productos.producto_id', '=', 'productos.id')
                            ->where('oferta_productos.oferta_id', $id_oferta)
                            ->select('oferta_productos.producto_id', 'productos.nom_producto', 'productos.img_producto', 'productos.precio')
                            ->get();
    return view('frontend.show_oferta', ['oferta' => $oferta, 'productos' => $productos_oferta]);
  }

  public function getCategories(){
    $categories = DB::table('categories')
      ->where('id', '!=', 1)
      ->select('id', 'name', 'slug')
      ->get();

    return $categories;
  }

  public function getAddToCart(Request $request, $tipo, $id) {
    if ($tipo == "o") { // el item recibido es una oferta
      $item = Oferta::find($id);
      $precio_venta = $item->precio;
    } elseif ($tipo == "p") { // el item recibido es un producto
      $item = Producto::find($id);  
      $precio_venta = $item->precio;
    }
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    /* 
    $item         => objeto del producto o oferta
    $item->id     => id del producto o oferta, ojo puede repetirse el id entre ofertas y productos
    $precio_venta => precio final del producto o de la oferta
    $tipo         => indica p -> producto , o -> oferta
    */
    $cart->add($item, $item->id, $precio_venta, $tipo);
    $request->session()->put('cart', $cart);
    return back();
  }

  public function getChangeQty($id, $cantidad) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->changeQty($id, $cantidad);
    Session::put('cart', $cart);
    return redirect()->route('producto.carrito_de_compras');
  }

  public function getCart() {
    if (!Session::has('cart')) {
      return view('frontend.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    /*dd($cart->items['o-5']);*/
    /*dd($cart->items);*/
    return view('frontend.shopping-cart', ['productos' => $cart->items, 'totalPrice' => $cart->totalPrice]);
  }
}
