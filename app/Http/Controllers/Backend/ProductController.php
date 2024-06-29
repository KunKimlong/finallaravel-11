<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function viewProduct(){
        $products = Product::select('product.*','category.name as cate_name','users.name as username')
                    ->join('category','product.category','=','category.id')
                    ->join('users','product.author','=','users.id')
                    ->get();
        // $products = Product::get();
        // return $products;
        return view('backend.list-proudct',compact('products'));
    }
    public function openAddProduct(){

        $categories = Category::get();

        return view('backend.add-product',compact('categories'));
    }
    public function addProduct(Request $request){
        $name = $request->name; 
        $qty  = $request->qty;
        $regular_price  = $request->regular_price;
        $sale_price = $request->sale_price;
        $size = $request->size;
        $color = $request->color;
        $category = $request->category;
        $thumbnail = $request->thumbnail;
        $description = $request->description;

        if(!($sale_price)){
            $sale_price=0;
        }

        $strSize = implode(',',$size);
        $strColor = implode(',',$color);

        // return $request;

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('uploads',$thumbnailName);
        }

        $user = Auth::user()->id;

        try {
            Product::create([
            'name'=>$name,
            'qty'=>$qty,
            'regular_price'=>$regular_price,
            'sale_price'=>$sale_price,
            'color'=>$strColor,
            'size'=>$strSize,
            'author'=>$user,
            'viewer'=>0,
            'category'=>$category,
            'thumbnail'=>$thumbnailName,
            'description'=>$description
            ]);

            return redirect()->route('openAddPro')->with('success','');
        } catch (Exception $e) {
            return redirect()->route('openAddPro')->with('error','');
        }
    }
    public function openUpdateProduct($id){
        $product = Product::find($id);
        $categories = Category::get();
        return view('backend.update-product',compact('product','categories'));
    }
    public function updateProduct(Request $request){
        $id   = $request->id;
        $name = $request->name; 
        $qty  = $request->qty;
        $regular_price  = $request->regular_price;
        $sale_price = $request->sale_price;
        $size = $request->size;
        $color = $request->color;
        $category = $request->category;
        $thumbnail = $request->thumbnail;
        $description = $request->description;

        if(!($sale_price)){
            $sale_price=0;
        }

        $strSize = implode(',',$size);
        $strColor = implode(',',$color);

        // return $request;

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('uploads',$thumbnailName);
        }
        else{
            $thumbnailName = $request->old_thumbnail;
        }

        $user = Auth::user()->id;

        try {
            Product::where('id',$id)->update([
            'name'=>$name,
            'qty'=>$qty,
            'regular_price'=>$regular_price,
            'sale_price'=>$sale_price,
            'color'=>$strColor,
            'size'=>$strSize,
            'author'=>$user,
            'viewer'=>0,
            'category'=>$category,
            'thumbnail'=>$thumbnailName,
            'description'=>$description
            ]);

            return redirect()->route('viewPro')->with('success','');
        } catch (Exception $e) {
            return redirect()->route('openUpdatePro',$id)->with('error','');
        }  
    }
    public function deleteProduct(Request $request){
        $id = $request->remove_id;
        Product::where('id',$id)->delete();
        return redirect()->route('viewPro')->with('deletesuccess','');
    }
}
