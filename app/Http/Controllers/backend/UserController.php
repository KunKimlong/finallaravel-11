<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Sign In
    public function Signin() {
        return view('backend.login');
    }

    public function SigninSubmit(Request $request) {
        $name_email = $request->name_email;
        $password   = $request->password;
        $rememberMe = $request->remember;

        if(Auth::attempt([
            'name'     => $name_email,
            'password' => $password
        ], $rememberMe)) {
            return redirect('/admin');
        }
        else {
            return redirect('/signin')->with('status', 'Invalid Credential');
        }

    }

    // Sign Up
    public function Signup() {
        return view('backend.register');
    }

    public function SignupSubmit(Request $request) {
        $name     = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $file     = $request->file('profile');
        $profile  = $this->uploadFile($file);

        $user = DB::table('users')->insert([
            'name'       => $name,
            'email'      => $email,
            'password'   => Hash::make($password),
            'profile'    => $profile,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        if($user) {
            return redirect('register')->with('message', 'Register Successfully');
        }
        else {
            return redirect('register')->with('message', 'Oppp! Something went wrong');
        }
    }

    //Logout
    public function SignOut() {
        Auth::logout();
        return redirect('signin');
    }
}
