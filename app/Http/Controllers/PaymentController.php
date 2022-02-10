<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function addBookingPayment(Request $request)
    {


        $request->validate([

            'pay_type' => "required",


        ]);


        if ($request->id) {

            $payment = Payment::find($request->id);
        } else

            $payment = new Payment;

        $payment->customer_id = $request->customer_id;

        $payment->booking_id = $request->booking_id;
        $payment->total_price = $request->total_price;
        $payment->total_discount = $request->total_discount;
        $payment->payable_amount = $request->payable_amount;

        $payment->date = Carbon::now()->toDateString();
        $payment->type   = $request->pay_type;

        $payment->save();


$booking =Booking::where('id','=',$request->booking_id)->first();
$booking->status=1;
$booking->save();



$message=[

    'message' => 'success',
    'id'=> $payment->id,

];


return [
    'return' => $message,
 ];

    }
}
