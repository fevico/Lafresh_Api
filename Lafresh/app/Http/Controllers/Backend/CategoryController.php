<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    //
    public function AllCategory(){
        $category = Category::latest()->get();
        return response()->json($category);
    }
    
    public function AddCategory(Request $request){
        
        $add_category = Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        return response()->json($add_category);
    }

    public function EditCategory(Request $request, $id){
        $update_cat = Category::findOrfail($id);

        $update_cat->category_name = $request->input('category_name');
        $update_cat->updated_at = Carbon::now();

        $update_cat->save();
        
        return response()->json($update_cat);
    }
    
    public function DeleteCategory($id){
        Category::findOrFail($id)->delete();
        return response()->json('true');
    }
}