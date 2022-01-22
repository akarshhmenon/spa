<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function addCustomer(Request $request)
    {


        $request->validate([

            'name' => "required|min:3|max:255",
        
            'mobile' => "required|min:10|max:10|unique:customers,mobile,$request->id"
        ]);


        if ($request->id) {

            $Customer = Customer::find($request->id);
        } else

            $Customer = new Customer;
        $Customer->user_id = Auth::user()->id;
        $Customer->name = strtoupper($request->name);
        $Customer->mobile = $request->mobile;
        $Customer->email = $request->email;
        $Customer->save();

        return 'success';
    }


    public function getCustomers()
    {


        return Customer::orderBy('id','desc')->get();
    }
   
    }

    public function deleteCustomer(Request $request)
    {
        if ($request->id) {
            $customer = Customer::find($request->id);
            $customer->delete();
            return 'success';
        } else {

            return "failed";
        }
    }

}
