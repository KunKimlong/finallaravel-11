<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProduct(){
        $products = Product::get();
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

        try {
            Product::create([
            'name'=>$name,
            'qty'=>$qty,
            'regular_price'=>$regular_price,
            'sale_price'=>$sale_price,
            'color'=>$strColor,
            'size'=>$strSize,
            'author'=>0,
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


    }
    public function updateProduct(Request $request){

    }
    public function deleteProduct(){

    }
}
