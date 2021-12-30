<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function addEmployee(Request $request)
    {


        $request->validate([

            'name' => "required|min:3|max:255",
            'email' => "required|email|unique:employees,email,$request->id",
            'mobile' => "required|min:10|max:10|unique:employees,mobile,$request->id"
        ]);


        if ($request->id) {

            $Employee = Employee::find($request->id);
        } else

            $Employee = new Employee;
        $Employee->user_id = Auth::user()->id;
        $Employee->name = strtoupper($request->name);
        $Employee->designation_id = $request->designation_id;
        $Employee->mobile = $request->mobile;
        $Employee->email = $request->email;
        $Employee->address_1 = $request->address_1;
        $Employee->address_2 = $request->address_2;
        $Employee->status = 0; // 0= Active 1= Not Active;
        $Employee->save();

        return 'success';
    }


    public function getEmployees()
    {


        return Employee::with('designations')-> orderBy('id','desc')->get();
    }


    public function deleteEmployee(Request $request)
    {
        if ($request->id) {
            $employee = Employee::find($request->id);
            $employee->delete();
            return 'success';
        } else {

            return "failed";
        }
    }

}
