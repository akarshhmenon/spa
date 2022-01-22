<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Singleproductcontroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleProductPage()
    {
        return view('users.singleproduct');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productPage()
    {
        return view('users.products');
    }
    
}
