<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendProductos extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.list_prodxcategory');
    }
}
