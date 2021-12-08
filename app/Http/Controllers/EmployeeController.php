<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'name' => "required",
            'mobile'=>'min:10|max:10',
            'designation_id' => "required"
        ]);

        if($request->id){
            $employee = Employee::find($request->id);
        }
        else
            $employee = new Employee;


        $employee->name = $request->name;
        $employee->mobile = $request->mobile;
        $employee->designation_id = $request->designation_id;
        $employee->save();
        return 'success';
    }
    public function getEmployees()
    {

        $employees = Employee::with('designation')->orderBy('name','ASC');
        return  $employees->get();

    }

    public function deleteEmployee(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $wmployee = Employee::find($request->id);
        $wmployee->delete();

        return 'success';


    }

}
