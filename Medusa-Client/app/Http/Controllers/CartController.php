<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Product_stock;
use App\Models\Product_size;
use App\Models\Product_color;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\delivery_address;
use Illuminate\Support\Facades\Log;
use DB;
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
            $Cart_item['total'] = $request->quantity*$product->price;
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
        $cart = Cart::firstOrCreate(['user_id'=>$userId]);
        // $cart = Cart::where('user_id',$userId)->first();
        $cart_item = Cart_item::where('cart_id',$cart->id)->get();
        $subtotal = Cart_item::where('cart_id',$cart->id)->sum('total');
        // print($subtotal);
        // $sumPrice = Cart_item::sum('price');
        // print( $sumPrice);

        return view('Client.Pages.Cart.Cart',compact('cart_item','subtotal'));
    }



    public function decQuantityCart($id)
    {
        $cartItemById = Cart_item::find($id);
        if($cartItemById->quantity - 1 =='0'){
            $cartItemById->delete();
        }else{
            $cartItemById->quantity=$cartItemById->quantity - 1;
            $cartItemById->total=$cartItemById->quantity*$cartItemById->price;
            $cartItemById->save();
        }
        return redirect('cart/show-cart');
    }
    public function incQuantityCart($id)
    {
        $cartItemById = Cart_item::find($id);
        $cartItemById->quantity=$cartItemById->quantity + 1;
        $cartItemById->total=$cartItemById->quantity*$cartItemById->price;
        $cartItemById->save();
        return redirect('cart/show-cart');
    }
    public function deleteCart($id)
    {
        Cart_item::find($id)->delete();
        return redirect('cart/show-cart');
    }


    //---------------------------------------------------- ChechOut
    public function viewCheckOut()
    {
        $userId = Auth::user()->id;
        $cart = Cart::where('user_id',$userId)->first();
        $subtotal = Cart_item::where('cart_id',$cart->id)->sum('total');
        $cart_item = Cart_item::where('cart_id',$cart->id)->get();
        $address = delivery_address::where('user_id',$userId)->where('status','1')->first();
       return view('Client.Pages.Cart.CheckOut',compact('cart_item','address','subtotal'));
    }
    // --------------------------------------------------Order-----------
    public function orderPlace(Request $request)
    {
        try {
            DB::beginTransaction();
            $userId = Auth::user()->id;
            $cart = Cart::where('user_id',$userId)->first();
            $address= delivery_address::where('user_id',$userId)->where('status','1')->first();
            $subtotal = Cart_item::where('cart_id',$cart->id)->sum('total');

            $order = new Order();
            $order->user_id = $userId;
            $order->status = '1';
            $order->subTotal = $subtotal;
            $order->tax = '0';
            $order->shipping = '0';
            $order->total = $order->subTotal+ $order->tax+$order->shipping;
            $order->name = $address->name;
            $order->phone = $address->phone;
            $order->email = Auth::user()->email;
            $order->address = $address->address;
            $order->district = $address->district;
            $order->conscious = $address->conscious;
            $order->city = $address->city;
            $order->content = $request->note;
            $order->save();
            foreach ($cart->cart_item as $key => $data) {
                $order_item = new Order_item();
                $order_item->order_id = $order->id;
                $order_item->product_id = $data->product_id;
                $order_item->name = $data->name;
                $order_item->price = $data->price;
                $order_item->quantity = $data->quantity;
                $order_item->total = $data->total;
                $order_item->size = $data->size;
                $order_item->color = $data->color;
                $order_item->save();
            }
            $transaction = new Transaction();
            $transaction->user_id = $userId;
            $transaction->order_id = $order->id;
            $transaction->code = '';
            $transaction->type = $request->pay;
            $transaction->status = '1';
            $transaction->save();
            Cart_item::where('cart_id',$cart->id)->delete();
            DB::commit();
            return redirect('/');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }


    }

}
