<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\product_images;
use Illuminate\Http\Request;
use App\Models\Category;
class ProductController extends Controller
{
    public function viewProductDetail($slug)
    {
        $productDetail = Products::where('slug',$slug)->first();
        $imageDetail =  product_images::where('product_id',$productDetail->id)->get();
        $nameCategory = Category::where('id',$productDetail->category_id)->select('name')->first();
        return view('Client.Pages.Product.Detail',compact('productDetail','imageDetail','nameCategory'));
    }
}
