<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
       return view('Client.Pages.Login.login');
    }
    public function checkLoginClient(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return Redirect::to('/');
        }else{
            $request->session()->put('message','Mat Khau hoac Tai Khoan sai');
            return Redirect::to('/login');
        }
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
}
