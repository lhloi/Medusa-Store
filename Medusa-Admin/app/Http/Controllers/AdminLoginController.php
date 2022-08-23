<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Hash;
class AdminLoginController extends Controller
{
    public function viewLoginAdmin(){
        // print_r(Hash::make('123456'));
        return view('admin.Login.Login');
    }
    public function checkLoginAdmin(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return Redirect::to('admin/');
        }else{
            $request->session()->put('message','Mat Khau hoac Tai Khoan sai');
            return Redirect::to('/admin-login');
        }
    }
    public function logoutAdmin(){
        Auth::logout();
        return Redirect::to('/admin-login');
    }
}
