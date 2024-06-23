<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function openregister(){
        return view('backend.register');
    }
    public function register(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $profile = $request->profile;

        if($profile){
            $profileName = rand(1,9999).'_'.$profile->getClientOriginalName();
            $profile->move('uploads',$profileName);
        }

        try {
            User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make($password),
                'profile'=>$profileName
            ]);
            return redirect('/login');
        } catch (Exception $th) {
            return redirect('/register')->with('error','');
        }
        
    }
    public function openlogin(){
        return view('backend.login');
    }
    public function login(Request $request){
        $name_email = $request->name_email;
        $password   = $request->password;
        // return Auth::attempt(['name'=>$name_email,'password'=>$password]);
        if(Auth::attempt(['name'=>$name_email,'password'=>$password])){
            return redirect()->route('home');
        }
        else if(Auth::attempt(['email'=>$name_email,'password'=>$password])){
            return redirect()->route('home');
        }
        else {
            return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
