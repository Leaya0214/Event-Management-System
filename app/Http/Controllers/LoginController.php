<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginIndex(){
        return view('BackEnd.admin.login');
    }


    public function login(Request $request )
    {
        // return $request->all();
            $validators = $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);

            if(Auth::attempt($validators)){ 
                if(Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin' || Auth::user()->type == 'stuff' ){
                    if(Auth::user()->type == 'admin'){
                        session()->flash('login_success','Welcome To Bridal Harmony');
                        return redirect()->intended(route('admin.index'));
                    }else if(Auth::user()->type == 'super_admin'){
                        session()->flash('login_success','Welcome To Bridal Harmony');
                        return redirect()->intended(route('admin.index'));
                    }else{
                        session()->flash('login_success','Welcome To Your Dashboard');
                        return redirect()->intended(route('dashboard.stuff'));
                    }
                }else{
                    session()->flash('login_error','Permission Denied!');
                    return redirect()->intended(route('admin.login')); 
                }
            }else{
                session()->flash('login_error','Invalid email and password!');
                return redirect()->route('admin.login');
            }

        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
