<?php

namespace App\Http\Controllers;

use App\Mail\BookingCancelled;
use App\Mail\BookingOTP;

use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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


    public function sendOtp(Request $request)
    {
        $request->validate([

            'name' => "required|min:3|max:255",
            'email' => "required|email",
            'date' => "required",
            'service_id' => "required",
            'mobile' => "required|min:10|max:10"

        ]);

        // alphanumeric random string generator


        if ($request->email) {


            $length = 4;
            $str = '1234567890';

            $otp = substr(str_shuffle($str), 0, $length);




            // send mail
            $name = strtoupper($request->name);
            $otp_details = [


                'name' => $name,
                'otp' =>   $otp,
                'message' => 'Thank You',


            ];


            Mail::to($request->email)->send(new BookingOTP($otp_details));

            Session::put($request->email, $otp);

            return 'success';
        } else {
            return 'failed';
        }
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

        $otp = Session::get($request->email);

        if ($request->otp == $otp) {

            if ($request->id) {

                $booking = Booking::find($request->id);
            } else

                $booking = new Booking;

            $booking->name = strtoupper($request->name);
            $booking->mobile = $request->mobile;
            $booking->email = $request->email;
            $booking->service_id = $request->service_id;
            $booking->employee_id = $request->employee_id;
            $booking->date = $request->date;
            $booking->time = $request->time;


            $booking->save();

            if (Customer::where('email', '=', $request->email)->exists()) {


                $customer = Customer::where('email', '=', $request->email)->first();
            } else

                $customer = new Customer;

            $customer->name = strtoupper($request->name);
            $customer->email = $request->email;
            $customer->mobile = $request->mobile;
            $customer->save();


            Session::forget($request->email);

            return 'success';
        } else {
            return 'wrongOtp';
        }
    }

public function getBookings(Request $request){


   
    $booking= Booking::with('service')->orderBy('time','ASC');

    if ($request->from_date) {

        $booking->where('date', '>=', $request->from_date);
    }
    if ($request->to_date) {

        $booking->where('date', '<=', $request->to_date);
    }
    if (!$request->from_date && !$request->to_date) {
        $booking->where('date', '=',Carbon::now()->toDateString());
    }

    return  $booking->get();

}


public function deleteBooking(Request $request)
{
    if ($request->id && $request->email) {
        $booking = Booking::find($request->id);
        $booking->delete();

        $delete_booking_details = [


            'name' => $request->name,
        
            'message' => ' We Apologize For the Inconvenience',


        ];


        Mail::to($request->email)->send(new BookingCancelled($delete_booking_details));
        return 'success';
    } else {

        return "failed";
    }
}




}
