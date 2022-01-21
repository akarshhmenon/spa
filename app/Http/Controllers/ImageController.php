<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
  public function addImage(Request $request){




    
if ($request->hasFile('image')) {

  $itemImage = new Image;

  $image_ext = $request->file('image')->getClientOriginalExtension();
  $service_filename = $request->name . time() . '.' . $image_ext;
  $path = $request->file('image')->move(public_path('uploads'), $service_filename); //pdf save public folder / uploads/course_syllabus


  $itemImage->user_id = Auth::user()->id;
  $itemImage->item_id = $request->item_id;
  $itemImage->type = $request->type;
  $itemImage->status = 0;

  $itemImage->image_name = $service_filename;
  $itemImage->save();
  
}

return 'success';

  }


  public function getImages(Request $request){

   

    return Image::where('item_id','=',$request->id)->get();

  }

 public function DeleteImage(Request $request){

   

  if ($request->id) {
    $designation = Image::find($request->id);
    $designation->delete();
    return 'success';
} else {

    return "failed";
}

  }



  


}
