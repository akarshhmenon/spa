<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
     

$todays_booking=Booking::where('date','=',Carbon::now()->toDateString())->get();
$completed_booking=Booking::where('date','=',Carbon::now()->toDateString())->where('status','=',1) ->get();
$cancelled_booking=Booking::where('date','=',Carbon::now()->toDateString())->where('status','=',2) ->get();


$todays_sales = Sale::where('invoice_date','=',Carbon::now()->toDateString())->get();
$total_cash_sales = Sale::where('invoice_date','=',Carbon::now()->toDateString())->where('pay_type','=','Cash')->get();
$total_bank_sales = Sale::where('invoice_date','=',Carbon::now()->toDateString())->where('pay_type','=','Bank')->get();
        $details[] = [

            'todays_booking'  =>$todays_booking->count() ,
            'completed_booking'  =>$completed_booking->count() ,
            'cancelled_booking'  =>$cancelled_booking->count() ,
             'todays_sales'=> $todays_sales->count(),
             'total_cash_sales'=>$total_cash_sales->sum('total_pay_amount'),
             'total_bank_sales'=>$total_bank_sales->sum('total_pay_amount'),
        ];
        return $details;
    }
}
