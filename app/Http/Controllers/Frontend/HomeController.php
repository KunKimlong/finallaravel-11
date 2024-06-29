<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        
        $promotion = Product::select('*')->where('regular_price','!=','sale_price')->get();
        // return $promotion;
        $newProduct = Product::orderBy('id','desc')->limit(4)->get();
        $popularProduct = Product::orderBy('viewer','desc')->limit(4)->get();
        // return $promotion;
        return view("frontend.index",compact('promotion','newProduct','popularProduct'));
    }
}
