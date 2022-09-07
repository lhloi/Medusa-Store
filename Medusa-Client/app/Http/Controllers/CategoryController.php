<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::where('parent_id','0')->orderBy('created_at','asc')->get();
        $products= Products::paginate(9);
        return view('Client.Pages.Shop.shop',compact('products','categorys'));
    }
    public function getProductByCategory($slug)
    {
        $categorys = Category::where('parent_id','0')->orderBy('created_at','asc')->get();
        $slug = Category::where('slug',$slug)->first();
        $product = Products::where('category_id',$slug->id)->paginate(9);

        // print_r($product);
        return view('Client.Pages.Shop.shopByCategory',compact('product','categorys','slug'));

    }
}
