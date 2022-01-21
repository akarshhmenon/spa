<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{public function addCategory(Request $request)
    {


        $request->validate([

            'name' => "required|min:3|max:255|unique:categories,name,$request->id"

        ]);


        if ($request->id) {

            $category = Category::find($request->id);
        } else

            $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->name = strtoupper($request->name);
        $category->description = $request->description;
       
        $category->save();

        return 'success';
    }


    public function getCategory()
    {


        return Category::orderBy('id','desc')->get();
    }

    public function deleteCategory(Request $request)
    {
        if ($request->id) {
            $category = Category::find($request->id);
            $category->delete();
            return 'success';
        } else {

            return "failed";
        }
    }
}