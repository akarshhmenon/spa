<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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

        $details[] = [

            'todays_booking'  =>$todays_booking->count() ,
            'completed_booking'  =>$completed_booking->count() ,
            'cancelled_booking'  =>$cancelled_booking->count() ,

        ];
        return $details;
    }
}
