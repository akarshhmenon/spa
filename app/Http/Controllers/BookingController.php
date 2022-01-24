<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
            //  return $request->all();
               
            $request->validate([

            'name' => "required|min:3|max:255",
            'email' => "required|email",
            'mobile' => "required|min:10|max:10"

        ]);
        // if ($request->id){

        //     $booking = Booking::findOrFail($request->id);
        // } else

            $booking = new Booking;
       
        $booking->name = strtoupper($request->name);
        $booking->mobile =$request->mobile;
        $booking->email =$request->email;
        $booking->service_id=$request->service_id;
        $booking->employee_id=$request->employee_id;
        $booking->date =$request->date;
        $booking->time =$request->time;
       
       
        $booking->save();

        return 'success';
    }
    
}
