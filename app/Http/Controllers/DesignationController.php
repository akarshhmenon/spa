<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function addDesignation(Request $request)
    {


        $request->validate([

            'name' => "required|min:3|max:255|unique:designations,name,$request->id"

        ]);


        if($request->id){

            $designation= Designation::find($request->id);
        }else

        $designation= new Designation;
        $designation->user_id = Auth::user()->id;
        $designation->name = strtoupper($request->name);
        $designation->description=$request->description;
        $designation->status=0; // 0= Active 1= Not Active;
        $designation->save();

      return 'success';

    }


public function getDesignation(){


    return Designation::all();
}



}
