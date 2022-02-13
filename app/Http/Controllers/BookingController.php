<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking()
    {
        return view('users.booking');
    }
    public function addBooking(Request $request)
    
         {
             
               
            $request->validate([

            'name' => "required|min:3|max:255",
            'email' => "required|email",
            'date' => "required",
            'service_id' => "required",
            'mobile' => "required|min:10|max:10"

        ]);
        if ($request->id){

            $booking = Booking::find($request->id);
        } else

            $booking = new Booking;
       
        $booking->name = strtoupper($request->name);
        $booking->mobile =$request->mobile;
        $booking->email =$request->email;
        $booking->service_id=$request->service_id;
        $booking->employee_id=$request->employee_id;
        $booking->date =$request->date;
        $booking->time =$request->time;
       
       
        $booking->save();

if(Customer::where('email','=', $request->email )->exists()){


$customer = Customer::where('email','=',$request->email)->first();

}else

$customer =new Customer;

$customer->name=strtoupper($request->name);
$customer->email=$request->email;
$customer->mobile=$request->mobile;
$customer->save();



        return 'success';
    }
    
}
