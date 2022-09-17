<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\delivery_address;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function Profile()
    {
        $profile = profile::where('user_id',Auth::user()->id)->first();
        // print($profile);
       return view('Client.Pages.User.profile',compact('profile'));
    }
    public function saveProfile(Request $request)
    {
        $user_id =Auth::user()->id;
        $profile_user = profile::where('user_id',Auth::user()->id)->get();
        if($profile_user->count() == 0){
            $profile = new profile();
        }else{
            $profile = profile::where('user_id',Auth::user()->id)->first();
        }
        $profile->user_id = $user_id;
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->birthday = $request->birthday;
        // $profile->address = $request->address;
        $profile->save();
        return redirect('user/profile');

    }
    //------------------------------------------ address
    public function Address()
    {
        $address = delivery_address::where('user_id',Auth::user()->id)->get();
        // print($profile);
       return view('Client.Pages.User.address',compact('address'));
    }
    public function saveAddress(Request $request)
    {
        $user = Auth::user()->id;
        $address = new delivery_address();
        $address->user_id = $user;
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->conscious = $request->conscious;
        $address->district = $request->district;
        $address->address = $request->address;
        $address->address_type = $request->address_type;
        $address->status = '0';
        $address->save();
        return redirect('user/address');

    }
    public function defaultAddress($id)
    {
        $user_id =Auth::user()->id;
        delivery_address::where('id','!=',$id)->where('user_id',$user_id)->update(['status'=>0]);
        delivery_address::where('id',$id)->update(['status'=>1]);

        return redirect('user/address');

    }
    public function deleteAddress($id)
    {
        delivery_address::where('id',$id)->delete();
        return redirect()->back();
    }
    //----------------------------------------Order
    public function viewOrder()
    {
        $user_id =Auth::user()->id;
        $order = Order::where(['user_id'=>$user_id])->get();
        // $order_item = Order_item::where('order_id',$order->id)->get();
        return view('Client.Pages.User.listOrder',compact('order'));
        // print_r($order);
    }
    public function destroyOrder($id)
    {
        $user_id =Auth::user()->id;
        $order = Order::find($id);
        $order->status = '5';
        $order->save();
        return redirect()->back();
    }

}
