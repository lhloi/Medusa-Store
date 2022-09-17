<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Products;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $feature = Products::orderBy('views','desc')->take(3)->get();
        // print_r($feature);
        $slider = Slider::where('status','1')->orderBy('created_at','desc')->get();
        $category = Category::where('parent_id','0')->orderBy('created_at','asc')->get();
        $product = Products::orderBy('created_at','desc')->take(8)->get();
        return view('Client.Pages.Home.home',compact('slider','category','product','feature'));
    }
}
