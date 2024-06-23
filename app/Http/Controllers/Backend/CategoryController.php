<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewCategory(){
        $categories = Category::get();
        return view('backend.list-category',compact('categories'));
    }
    public function openAdd(){
        return view('backend.add-category');
    }
    public function addCategory(Request $request){
        $name = $request->name;
        try{
            Category::create([
                'name'=>$name,
            ]);
            return redirect()->route('openAddCate')->with('success','');
        }catch(Exception $e){
            return redirect()->route('openAddCate')->with('error','');
        }
    }
    public function openUpdate($id){
        $category = Category::where('id',$id)->first();
        return view('backend.update-category',compact('category'));
    }
    public function updateCategory(Request $request){
        $id = $request->id;
        $name = $request->name;
        try{
            Category::where('id',$id)->update([
                'name'=>$name,
            ]);
            return redirect('/openupdatecategory/'.$id)->with('success','');
        }catch(Exception $e){
            return redirect('/openupdatecategory/'.$id)->with('error','');
        }
    }
    public function deleteCategory(Request $request){
        $id = $request->remove_id;

        Category::where('id',$id)->delete();

        return redirect()->route('viewCate')->with('success','');
    }
}
