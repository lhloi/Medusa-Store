<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Products;
use App\Models\Order_item;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $seller = Order_item::select('product_id',Order_item::raw('count(product_id) as qty'))->groupBy('product_id')->orderBy('qty','desc')->take(3)->get();
        // print($seller);
        // foreach ($seller as $key => $value) {
        //     // echo($value->product);
        //     print($value->product->first()->id);
        //     // foreach ($value->product_id->product as $key => $a) {
        //     //     print($a);
        //     // }
        // }
        $feature = Products::orderBy('views','desc')->take(3)->get();

        $slider = Slider::where('status','1')->orderBy('created_at','desc')->get();
        $category = Category::where('parent_id','0')->orderBy('created_at','asc')->get();
        $product = Products::orderBy('created_at','desc')->take(8)->get();
        return view('Client.Pages.Home.home',compact('slider','category','product','feature','seller'));
    }
}
