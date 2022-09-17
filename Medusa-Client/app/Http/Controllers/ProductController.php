<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\product_images;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;
class ProductController extends Controller
{
    public function viewProductDetail($slug)
    {
        $productDetail = Products::where('slug',$slug)->first();

        $sessionKey = 'post_' . $productDetail->id;
        $sessionView = Session::get($sessionKey);
        $views = Products::findOrFail($productDetail->id);
        if (!$sessionView) { //nếu chưa có session
            Session::put($sessionKey, 1); //set giá trị cho session
            $views->increment('views');
        }
        $imageDetail =  product_images::where('product_id',$productDetail->id)->get();
        $nameCategory = Category::where('id',$productDetail->category_id)->select('name')->first();
        return view('Client.Pages.Product.Detail',compact('productDetail','imageDetail','nameCategory'));
    }
}
