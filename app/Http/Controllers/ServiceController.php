<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class serviceController extends Controller
{



  public function servicePage(){
    return view('users.services');

  }





    public function addService(Request $request)
    {
 
        $request->validate([

            'name' => "required|min:3|max:255",
           
        ]);


        if ($request->id) {

            $service = Service::find($request->id);
        } else

            $service = new Service;
            //img start
// if($request->hasFile('image')){ 
//     $image =$request->file('image');
//     $ext =$image->extension();
//     $file = time().'.'.$ext;
//     $image->storeAs('public/uploads',$file);
//     $service->image=$file;
// }

if ($request->hasFile('image')) {
    $image_ext = $request->file('image')->getClientOriginalExtension();
    $service_filename = $request->name . time() . '.' . $image_ext;
    $path = $request->file('image')->move(public_path('uploads'), $service_filename); //pdf save public folder / uploads/course_syllabus
    $service->image = $service_filename;
}
              //image end
       // $service->user_id = Auth::user()->id;
        $service->name = strtoupper($request->name);
        $service->categories_id = $request->category_id;
        $service->description = $request->description;
        $service->rate = $request->rate;
        $service->time = $request->time;
        $service->save();

        return 'success';
    }


    public function getService()
    {


        return Service::with('category')-> orderBy('id','desc')->get();
    }







    public function deleteService(Request $request)
    {
        if ($request->id) {
            $service = Service::find($request->id);
            $service->delete();
            return 'success';
        } else {

            return "failed";
        }
    }

}