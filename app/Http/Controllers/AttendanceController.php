<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
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

            

        foreach ($request->employee_status as $status) {
            $Attendance = new Attendance;
            $Attendance->user_id = Auth::user()->id;
            $Attendance->date = $request->date;
            $Attendance->employee_id = $status['employee_id'];
            $Attendance->status = $status['status'];
            $Attendance->save();
        }

        return 'success';
    }


public function getEmployeesAttendance(){

return Attendance::with('employee')-> orderBy('id','desc')->get();

}




}
