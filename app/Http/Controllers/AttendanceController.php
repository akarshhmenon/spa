<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
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


    public function getEmployeesAttendance()
    {

        $attendance=  Attendance::with('employee')->orderBy('id', 'desc');

   $groups = $attendance->get()->groupBy('date');

     $groupwithcount = $groups->mapWithKeys(function ($group, $key) {
  
         return
             [
                 $key =>
                 [
                    
                    'date' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
         
                     'full_day' => $group->where('status', '3')->count(),
                     'half_day' => $group->where('status', '2')->count(),
                     'absent' => $group->where('status', '1')->count(),
                     'leave' => $group->where('status', '0')->count(),

                 ]
             ];
     });




     return $groupwithcount;


    }


    public function getEmployeesAttendanceReport(Request $request)
    {




        $attendance = Attendance::with('employee')->orderBy('id', 'desc');

        if ($request->from_date) {

            $attendance->where('date', '>=', $request->from_date);
        }
        if ($request->to_date) {

            $attendance->where('date', '<=', $request->to_date);
        }
        if (!$request->from_date && !$request->to_date) {
            $attendance->whereMonth('date', Carbon::now()->month);
        }


        $groups = $attendance->get()->groupBy('employee_id');

        $groupwithcount = $groups->mapWithKeys(function ($group, $key) {
            return
                [
                    $key =>
                    [
                        'employee_id' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                        'name' => Employee::where('id', $key)->value('name'),
                        'full_day' => $group->where('status', '3')->count(),
                        'half_day' => $group->where('status', '2')->count(),
                        'absent' => $group->where('status', '1')->count(),
                        'leave' => $group->where('status', '0')->count(),

                    ]
                ];
        });
        return $groupwithcount;
    }
}
