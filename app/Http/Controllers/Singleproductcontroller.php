<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ProductAndService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Singleproductcontroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleProductPage($id)
    {



        $product=ProductAndService::with('images')->where('id','=',$id)->first();

        return view('users.singleproduct',compact('product'));
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productPage()
    {
        $products=ProductAndService::with('images')->where('type','=','product')->get();
        return view('users.products',compact('products'));
    }
    
}
