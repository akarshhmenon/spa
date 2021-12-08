<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'name' => "required|min:3|max:255|unique:customers,name,$request->id",
            'mobile' => "required|min:10|max:10|unique:customers,mobile,$request->id"
        ]);


        if ($request->id) {


            $customer = Customer::find($request->id);
        } else
            $customer = new Customer;

        $customer->name = strtoupper($request->name);
        $customer->mobile = $request->mobile;
        if($request->gst_no)
            $customer->gst_no = $request->gst_no;
        $customer->user_id = Auth::user()->id;
        $customer->save();
        return 'success';
    }

    public function getCustomers(Request $request)
    {

        if($request->sale)
            $customers =  Customer::select('id','name','mobile', DB::raw("CONCAT(customers.name,'-',customers.mobile) AS full_name"))->orderBy('name', 'ASC')->get();
        else
            $customers =  Customer::select('id','name','mobile')->orderBy('name', 'ASC')->get();

        return $customers;
    }

    public function deleteCustomer(Request $request)
    {
        if ($request->id) {
            $customer = Customer::find($request->id);
            $customer->delete();
            return 'Success';
        } else {

            return "failed";
        }
    }
}
