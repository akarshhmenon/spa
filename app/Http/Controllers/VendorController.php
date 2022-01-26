<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function addVendor(Request $request)
    {


        $request->validate([

            'name' => "required|min:3|max:255",
            'mobile' => "required|min:10|max:10|unique:vendors,mobile,$request->id"
        ]);


        if ($request->id) {

            $Vendor = Vendor::find($request->id);
        } else

            $Vendor = new Vendor;
        $Vendor->user_id = Auth::user()->id;
        $Vendor->name = strtoupper($request->name);
        $Vendor->mobile = $request->mobile;
        $Vendor->location = $request->location;
        $Vendor->gstno = $request->gstno;
        $Vendor->address_1 = $request->address_1;
        $Vendor->address_2 = $request->address_2;
        $Vendor->state = $request->state;
        $Vendor->pincode = $request->pincode;
        $Vendor->save();

        return 'success';
    }


    public function getvendors()
    {


        return Vendor:: orderBy('id','desc')->get();
    }


    public function deleteVendor(Request $request)
    {
        if ($request->id) {
            $Vendor = Vendor::find($request->id);
            $Vendor->delete();
            return 'success';
        } else {

            return "failed";
        }
    }

}
