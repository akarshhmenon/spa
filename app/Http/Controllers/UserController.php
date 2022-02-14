<?php

namespace App\Http\Controllers;

use App\Models\ProductAndService;
use Illuminate\Http\Request;

class userController extends Controller
{

    public function index()
    {

        $products = ProductAndService::with('images')->where('type', '=', 'product')->where('add_to_home', '=', 1)->get();
        $services = ProductAndService::with('images')->where('type', '=', 'service')->where('add_to_home', '=', 1)->get();

        return view('users.userhome', compact('products', 'services'));
    }
}
