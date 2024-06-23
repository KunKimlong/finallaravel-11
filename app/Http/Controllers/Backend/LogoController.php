<?php

namespace App\Http\Controllers\Backend;

use App\Models\Logo;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoController extends Controller
{
    public function viewLogo(){

        $logos = Logo::get();
        // return $logos;

        return view('backend.list-logo',compact('logos'));
    }
    public function openAdd(){
        return view('backend.add-logo');
    }
    public function addLogo(Request $request){
        // return $request;
        $thumbnail = $request->thumbnail;
        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $path = 'uploads';
            $thumbnail->move($path,$thumbnailName);
        }
        try{
            Logo::create([
                'thumbnail'=>$thumbnailName
            ]);
            return redirect()->route('openaddLogo')->with('success','');
        }catch(Exception $e){
            return redirect()->route('openaddLogo')->with('error','');
        }
    }
    public function openUpdate($id){
        return view('backend.update-logo',compact('id'));
    }
    public function updateLogo(Request $request){
        $id = $request->id;
        $thumbnail = $request->thumbnail;
        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $path = 'uploads';
            $thumbnail->move($path,$thumbnailName);
        }
        try{
            Logo::where('id',$id)->update([
                'thumbnail'=>$thumbnailName
            ]);
            return redirect()->route('openUpdateLogo',$id)->with('success','');
        }catch(Exception $e){
            return redirect()->route('openUpdateLogo',$id)->with('error','');
        }

    }
    public function deleteLogo(Request $request){
        $id = $request->remove_id;

        Logo::where('id',$id)->delete();

        return redirect()->route("getLogo")->with('success','');        
        
    }
}
