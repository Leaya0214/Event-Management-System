<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\Client;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientLoginController extends Controller
{
    public function loginPage(){
        return view('FrontEnd.login');
    }

    public function submitLogin(Request $request){
        $user = Client::where('email', $request->input('email'))->first();
        // dd($user);
        if ($user && $user->password === $request->input('password')) {
            Auth::guard('client')->login($user); 
            Toastr::success('Welcome To Your Profile');
            return redirect()->route('client-info');
        } else {
            Toastr::error("Don't Have Any Account!");
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('login');
    }
}
