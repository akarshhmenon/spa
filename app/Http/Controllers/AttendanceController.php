<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function addAttendance(Request $request)
    {

        $request->validate([

            'date' => "required",

        ]);



        if ($request->id) {

            $Attendance = Attendance::find($request->id);
        } else

            $Attendance = new Attendance;
        $Attendance->user_id = Auth::user()->id;
        $Attendance->date = $request->date;
        foreach ($request->employee_status as $status) {
            
            $Attendance->employee_id = $status['id'];
            $Attendance->status = $status['status'];
        }

        $Attendance->save();

        return 'success';
    }
}
