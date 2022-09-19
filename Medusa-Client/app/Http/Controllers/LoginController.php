<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Social;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
class LoginController extends Controller
{
    public function login()
    {
        return view('Client.Pages.Login.login');
    }

    public function checkLoginClient(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::to('/');
        } else {
            $request->session()->put('message', 'Mat Khau hoac Tai Khoan sai');
            return Redirect::to('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }

    //------------------------------login facebook

    public function login_facebook()
    {
        return FacadesSocialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = FacadesSocialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = User::where('id', $account->user)->first();
            Session::put('user', $account_name->name);
            Session::put('id', $account_name->id);
            return redirect('/')->with('message', 'Đăng nhập Admin thành công');
        } else {

            $social = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook',
            ]);

            $orang = User::where('email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = User::create([

                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    // 'admin_status' => 1,

                ]);
            }
            $social->login()->associate($orang);
            $social->save();

            $account_name = User::where('id', $account->user)->first();

            Session::put('name', $account_name->name);
            Session::put('id', $account_name->id);
            return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }
}
