<?php

namespace App\Http\Controllers;

use App\Models\ProductAndService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class serviceController extends Controller
{



  public function servicePage(){

    $services=ProductAndService::with('images')->where('type','=','service')->get();
    return view('users.services',compact('services'));

  }


  public function singleServicePage($id){
    $service=ProductAndService::with('images')->where('id','=',$id)->first();
    return view('users.singleservice',compact('service'));

  }

    



}