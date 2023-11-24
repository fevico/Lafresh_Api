<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Carbon as SupportCarbon;

class ProductController extends Controller
{
    //
    public function AllProfile(){
        $product = Product::latest()->get();
        return response()->json($product);
    }

    public function AddProfile(Request $request){
        $response = Cloudinary::upload($request->file('image')->getRealPath());
        
        $add_product = Product::insert([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discription' => $request->discription,
            'discount' => $request->discount,
            'image' => $response->getSecurePath(),
            'created_at' => Carbon::now(),
        ]);
        
        return response()->json($add_product);
    }

    public function EditProduct(Request $request, $id){
        $pro_upd = Product::findOrFail($id);
        
        $pro_upd->product_name = $request->input('product_name', $pro_upd->product_name);
        $pro_upd->price = $request->input('price', $pro_upd->price);
        $pro_upd->discription = $request->input('discription', $pro_upd->discription);
        $pro_upd->discount = $request->input('discount', $pro_upd->discount);
        $pro_upd->updated_at = Carbon::now(); 
    
        // Check if a new  photo is provided
        if ($request->hasFile('image')) {
            // Upload the new profile photo to Cloudinary
            $response = Cloudinary::upload($request->file('image')->getRealPath());
            // Get the secure URL of the uploaded file
            $pro_upd->image = $response->getSecurePath();
        }

        $pro_upd->save();

        return response()->json($pro_upd);  
    }

    public function DeleteProduct($id){
         Product::findOrFail($id)->delete();
         return response()->json("true");
    }

}