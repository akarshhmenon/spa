<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'product_category'=>'required',
            'name' => "required|unique:products,name,$request->id"


            // .$this->product->id
        ]);


        if ($request->id) {


            $product = Product::FindOrFail($request->id);
        }
        else
            $product = new Product;

        $product->name = $request->name;
        $product->category_id = $request->product_category;
        $product->user_id = Auth::user()->id;
        if($request->opening_quantity)
        {
            $product->quantity = $request->opening_quantity;
            $product->opening_quantity = $request->opening_quantity;
        }
        if($request->reward_points)
        {
            $product->reward_points = $request->reward_points;
        }
        $product->gst = $request->gst;
        $product->mrp = $request->mrp;
        $product->save();
        return 'success';
    }

    public function getProducts()
    {

        $products = Product::with('category')->orderBy('name','ASC')->get();
        return  $products;

    }


    public function getStockProducts()
    {

        $products = Product::with('category')->orderBy('name','ASC')->where('category_id' ,'!=',3)->get();
        return  $products;

    }

    public function deleteProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $product = Product::find($request->id);
        $product->delete();
        return 'Success';

    }

}
