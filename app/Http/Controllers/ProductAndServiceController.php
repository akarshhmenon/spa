<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ProductAndService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAndServiceController extends Controller
{

    public function addService(Request $request)
    {

        $request->validate([

            'name' => "required|min:3|max:255|unique:product_and_services,name,$request->id",

        ]);


        if ($request->id) {

            $service = ProductAndService::find($request->id);
        } else

            $service = new ProductAndService;



        $service->user_id = Auth::user()->id;
        $service->name = strtoupper($request->name);
        $service->type = $request->type;
        $service->categories_id = $request->category_id;
        $service->description = $request->description;
        $service->mrp = $request->rate;
        $service->opening_quantity = 1;
        $service->quantity = 1;
        $service->time = $request->time;
        $service->save();






        if ($request->hasFile('image')) {

            $serviceImage = new Image;

            $image_ext = $request->file('image')->getClientOriginalExtension();
            $service_filename = $request->name . time() . '.' . $image_ext;
            $path = $request->file('image')->move(public_path('uploads'), $service_filename); //pdf save public folder / uploads/course_syllabus


            $serviceImage->user_id = Auth::user()->id;
            $serviceImage->item_id = $service->id;
            $serviceImage->type = $request->type;
            $serviceImage->status = 0;

            $serviceImage->image_name = $service_filename;
            $serviceImage->save();
        }






        return 'success';
    }


    public function getService()
    {


        return ProductAndService::with('category')->where('type', '=', 'service')->orderBy('id', 'desc')->get();
    }







    public function deleteService(Request $request)
    {
        if ($request->id) {
            $service = ProductAndService::find($request->id);
            $service->delete();
            return 'success';
        } else {

            return "failed";
        }
    }




    public function addProduct(Request $request)
    {

        $request->validate([

            'name' => "required|min:3|max:255|unique:product_and_services,name,$request->id",
            'opening_quantity' => "required",

        ]);


        if ($request->id) {

            $product = ProductAndService::find($request->id);
        } else

            $product = new ProductAndService;



        $product->user_id = Auth::user()->id;
        $product->name = strtoupper($request->name);
        $product->type = $request->type;
        $product->categories_id = $request->category_id;
        $product->description = $request->description;
        $product->mrp = $request->mrp;

        $product->batch_no = $request->batch_no;
        $product->hsn_code = $request->hsn_code;
        $product->mfg_date = $request->mfg_date;
        $product->exp_date = $request->exp_date;
        $product->rack_number = $request->rack_no;
        $product->gst = $request->gst;
        $product->quantity = $request->opening_quantity;
        $product->opening_quantity = $request->opening_quantity;
        $product->save();





        if ($request->hasFile('image')) {

            $productImage = new Image;

            $image_ext = $request->file('image')->getClientOriginalExtension();
            $service_filename = $request->name . time() . '.' . $image_ext;
            $path = $request->file('image')->move(public_path('uploads'), $service_filename); //pdf save public folder / uploads/course_syllabus


            $productImage->user_id = Auth::user()->id;
            $productImage->item_id = $product->id;
            $productImage->type = $request->type;
            $productImage->status = 0;

            $productImage->image_name = $service_filename;
            $productImage->save();
        }



        return 'success';
    }


    public function getProduct()
    {


        return ProductAndService::with('category')->where('type', '=', 'product')->orderBy('id', 'desc')->get();
    }

    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $product = ProductAndService::find($request->id);
            $product->delete();
            return 'success';
        } else {

            return "failed";
        }
    }




    public function getProductAndService()
    {

        return ProductAndService::with('category')->orderBy('id', 'desc')->get();
    }

    public function addToHome(Request $request)
    {


        if ($request->id) {
            $product_and_service = ProductAndService::find($request->id);
            $product_and_service->add_to_home = 1;
            $product_and_service->save();
            return 'success';
        } else {

            return "failed";
        }
    }

    public function removeFromHome(Request $request)
    {


        if ($request->id) {
            $product_and_service = ProductAndService::find($request->id);
            $product_and_service->add_to_home = 0;
            $product_and_service->save();
            return 'success';
        } else {

            return "failed";
        }
    }
}
