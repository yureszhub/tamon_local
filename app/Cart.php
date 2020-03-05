<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
    	if ($oldCart) {
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    /* 
    $item         => objeto del producto o oferta
    $item->id     => id del producto o oferta, ojo puede repetirse el id entre ofertas y productos
    $precio_venta => precio final del producto o de la oferta
    $tipo         => indica p -> producto , o -> oferta
    */
    public function add($item, $id, $precio_venta, $tipo) {
        $indice = $tipo . '-' . $id;
        $storedItem = ['codigo_item' => $indice, 'qty' => 0, 'price' => $precio_venta, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($indice, $this->items)) {
                $storedItem = $this->items[$indice];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $precio_venta * $storedItem['qty'];
        $this->items[$indice] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $precio_venta;
        /*dd($this);*/
    }

    /*public function add($item, $id, $descuento) {
    	if ($descuento > 0) {
    		$precio_venta = $item->precio - ($item->precio * $descuento / 100);
    	} else {
    		$precio_venta = $item->precio;
    	}
    	$storedItem = ['codigo_producto' => $item->id, 'qty' => 0, 'price' => $precio_venta, 'item' => $item, 'descuento' => $descuento];
    	if ($this->items) {
    		if (array_key_exists($id, $this->items)) {
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['qty']++;
    	$storedItem['price'] = $precio_venta * $storedItem['qty'];
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $precio_venta;
    }*/
    public function changeQty($id, $cant) {
        //recuperamos la actual cantidad del producto que estamos cambiando la cantidad
        $actual_qty = $this->items[$id]['qty'];
        
        //quitamos la actual cantidad del producto
        $this->totalQty -= $actual_qty;
        /*quitamos la actual cantidad del producto*/
            /*$this->items[$id]['qty']-=$actual_qty;*/
        /*actualizamos el precio total menos el articulo que estamos cambiando*/
        $this->totalPrice -= $this->items[$id]['price'];

        /*agregamos la nueva cantidad*/
        $this->items[$id]['qty'] = $cant;
        $this->totalQty += $cant;
        $precio_venta = $this->items[$id]['item']->precio;
        /*$this->items[$id]['price'] = ($this->items[$id]['item']['precio'])*($this->items[$id]['qty']);*/
        $this->items[$id]['price'] = ($precio_venta)*($this->items[$id]['qty']);
        /*actualizamos el Precio Total de toda la cotizacion*/
        $this->totalPrice += $this->items[$id]['price'];
        /*$this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['precio'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['precio'];*/

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function changeQtyOLD($id, $cant) {
    	/*recuperamos la actual cantidad del producto que estamos cambiando la cantidad*/
    	$actual_qty = $this->items[$id]['qty'];
    	$this->totalQty -= $actual_qty;
    	/*quitamos la actual cantidad del producto*/
    		/*$this->items[$id]['qty']-=$actual_qty;*/
    	/*actualizamos el precio total menos el articulo que estamos cambiando*/
    	$this->totalPrice -= $this->items[$id]['price'];

    	/*agregamos la nueva cantidad*/
    	$this->items[$id]['qty'] = $cant;
    	$this->totalQty += $cant;
    	/*actualizamos el importe total del articulo = cantidad por precio unitario*/
    	if ($this->items[$id]['descuento'] > 0) {
    		$precio_unitario = $this->items[$id]['item']['precio'];
    		$precio_venta = $precio_unitario - ($precio_unitario * $this->items[$id]['descuento'] / 100);
    	} else {
    		$precio_venta = $this->items[$id]['item']['precio'];
    	}
    	/*$this->items[$id]['price'] = ($this->items[$id]['item']['precio'])*($this->items[$id]['qty']);*/
    	$this->items[$id]['price'] = ($precio_venta)*($this->items[$id]['qty']);
    	/*actualizamos el Precio Total de toda la cotizacion*/
    	$this->totalPrice += $this->items[$id]['price'];
    	/*$this->items[$id]['qty']--;
    	$this->items[$id]['price'] -= $this->items[$id]['item']['precio'];
    	$this->totalQty--;
    	$this->totalPrice -= $this->items[$id]['item']['precio'];*/

    	if ($this->items[$id]['qty'] <= 0) {
    		unset($this->items[$id]);
    	}
    }
}
