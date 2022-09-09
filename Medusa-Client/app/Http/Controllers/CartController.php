<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Product_stock;
use App\Models\Product_size;
use App\Models\Product_color;
use App\Models\Cart;
use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;

// use Cart;
class CartController extends Controller
{
    public function saveCart(Request $request)
    {
        $userId = Auth::user()->id;
        $cart = Cart::firstOrCreate(['user_id'=>$userId]);

        $size = Product_size::find($request->size);
        $color = Product_color::find($request->color);
        $product = Products::find($request->product_id);
        $cart_item = Cart_item::where('product_id',$request->product_id)->where('size',$size->name)->where('color',$color->name)->first();

        if ($cart_item) {
            $cart_item->quantity = $cart_item->quantity + $request->quantity;
            $cart_item->save();
        }else{
            $Cart_item = new Cart_item();
            $Cart_item['cart_id'] =$cart->id;
            $Cart_item['product_id'] =$product->id;
            $Cart_item['price'] = $product->price;
            $Cart_item['quantity'] = $request->quantity;
            $Cart_item['name'] = $product->name;
            $Cart_item['size'] = $size->name;
            $Cart_item['color'] = $color->name;
            $Cart_item['image'] = $product->feature_image_path;
            $Cart_item->save();
        }

        // $cart_item = Cart_item::updateOrCreate($data);
        return redirect('cart/show-cart');

    }
    public function showCart()
    {
        $userId = Auth::user()->id;
        $cart = Cart::where('user_id',$userId)->first();
        $cart_item = Cart_item::where('cart_id',$cart->id)->get();
        // $sumPrice = Cart_item::sum('price');
        // print( $sumPrice);

        return view('Client.Pages.Cart.Cart',compact('cart_item'));
    }
    public function deleteCart($id)
    {
        Cart::remove($id);
        return redirect('cart/show-cart');
    }
    public function decQuantityCart($id)
    {
        $cartById = Cart::get($id)->qty;
        Cart::update($id,$cartById-1);
        // print_r($cartById);
        return redirect('cart/show-cart');

    }
    public function incQuantityCart($id)
    {
        $cartById = Cart::get($id)->qty;
        Cart::update($id,$cartById+1);

        return redirect('cart/show-cart');

    }
    public function viewCheckOut()
    {
       return view('Client.Pages.Cart.CheckOut');
    }
}
