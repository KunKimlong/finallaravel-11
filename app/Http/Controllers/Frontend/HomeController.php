<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

        $promotion = Product::whereRaw('regular_price != sale_price')->limit(4)->get();
        // return $promotion;
        $newProduct = Product::orderBy('id','desc')->limit(4)->get();
        $popularProduct = Product::orderBy('viewer','desc')->limit(4)->get();
        // return $promotion;
        return view("frontend.index",compact('promotion','newProduct','popularProduct'));
    }
    public function productDetail($id){
        $product = Product::find($id);
        $related_product = Product::where('category',"=", $product->category)->limit(4)->get();

        Product::where('id',$id)->update([
            'viewer'=>$product->viewer+1,
        ]);

        return view('frontend.product-detail',compact('product','related_product'));
    }
}


