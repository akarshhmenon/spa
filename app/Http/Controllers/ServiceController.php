<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class serviceController extends Controller
{



  public function servicePage(){
    return view('users.services');

  }





}