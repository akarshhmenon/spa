<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\CustomerCredit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function save(Request $request)
    {
        
        $request->validate([
            'customer_id'=>'required',
            'amount' => 'required',
            'paytype' => 'required',
        ]);
        
        
        if ($request->id)

            $payment = Payment::FindOrFail($request->id);


        else
            $payment = new Payment;
        
        
        if($request->payment_date)
        {
            
            $payment->payment_date = $request->payment_date;
            
        }
        else  
            $payment->payment_date= Carbon::today();
        
        $payment->customer_id = $request->customer_id;
        $payment->amount = $request->amount;
        $payment->pay_type = $request->paytype;
        $payment->user_id = Auth::user()->id;
        $payment->save();
        
        //adding entry to customer_credits
        if ($request->id)
            $customer_credit = CustomerCredit::where('payment_id',$payment->id)->first();
        else
            $customer_credit = new CustomerCredit;
        
        $customer_credit->user_id = Auth::user()->id;
        $customer_credit->customer_id = $request->customer_id;
        $customer_credit->payment_id = $payment->id;
        $customer_credit->amount = -$request->amount;
        $customer_credit->remarks = "PAYMENT AGAINST CREDIT";
        $customer_credit->save();
        
        
        if( $payment->save()){
            
            $forReciept=Payment::where('customer_id','=',$request->customer_id)->orderBy('id', 'desc')->first();
            return $forReciept;
            
        }
        
    }
    
    public function getPayments(Request $request)
    {
        
        $payments = Payment::with('customer')->where('credit',1)->orderBy('created_at','DESC');

        if ($request->from_date) {
            $payments->where('payment_date', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $payments->where('payment_date', '<=', $request->to_date);
        }
        return $payments->get();

        
    }
    
    public function deletePayment(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        
        $payment = Payment::FindOrFail($request->id);
        $customer_credit = CustomerCredit::where('payment_id',$payment->id)->first();
        $customer_credit->delete();
        $payment->delete();
        return 'Success';
        
    }
}
