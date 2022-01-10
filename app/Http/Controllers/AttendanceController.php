<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function addAttendance(Request $request)
    {





        if ($request->employee_status) {

            foreach ($request->employee_status as $status) {
                if ($status['id']) {

                    $Attendance = Attendance::find($status['id']);
                } else

                    $Attendance = new Attendance;
                $Attendance->user_id = Auth::user()->id;

                if ($request->date) {
                    $Attendance->date = $request->date;
                } else {
                    $Attendance->date = Carbon::now();
                }



                $Attendance->employee_id = $status['employee_id'];
                $Attendance->status = $status['status'];
                $Attendance->save();
            }

            return 'success';
        } else {

            return 'faild';
        }
    }


    public function getEmployeesAttendance()
    {

        $attendance =  Attendance::with('employee')->orderBy('date', 'desc');

        $groups = $attendance->get()->groupBy('date');

        $groupwithcount = $groups->mapWithKeys(function ($group, $key) {

            return
                [
                    $key =>
                    [

                        'date' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                        'count' => Employee::count(),
                        'attendance' => Attendance::with('employee')->where('date', $key)->get(),
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
                        'group_by_attendance' => $group

                    ]
                ];
        });
        return $groupwithcount;
    }
}
