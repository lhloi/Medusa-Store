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
use App\Models\Coupon;
use App\Models\Order_item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\delivery_address;
use Illuminate\Support\Facades\Log;
use DB;
use Session;
class CartController extends Controller
{
    public function saveCart(Request $request)
    {
        $userId = Auth::user()->id;
        $cart = Cart::firstOrCreate(['user_id'=>$userId]);
        $size = Product_size::find($request->size);
        $color = Product_color::find($request->color);
        $product = Products::find($request->product_id);
        $cart_item = Cart_item::where('product_id',$request->product_id)->where('size',$size->name)->where('color',$color->name)->where('cart_id',$cart->id)->first();

        if ($cart_item) {
            $cart_item->quantity = $cart_item->quantity + $request->quantity;
            $cart_item->save();
        }else{
            $cart_item = new Cart_item();
            $cart_item['cart_id'] =$cart->id;
            $cart_item['product_id'] =$product->id;
            $cart_item['price'] = $product->price;
            $cart_item['quantity'] = $request->quantity;
            $cart_item['total'] = $request->quantity*$product->price;
            $cart_item['name'] = $product->name;
            $cart_item['size'] = $size->name;
            $cart_item['color'] = $color->name;
            $cart_item['image'] = $product->feature_image_path;
            $cart_item->save();
        };

        // print_r($cart->id);
        // $cart_item = Cart_item::updateOrCreate($data);
        return redirect('cart/show-cart');

    }
    public function showCart()
    {
        $userId = Auth::user()->id;
        // print($userId);
        $cart = Cart::firstOrCreate(['user_id'=>$userId]);
        $cart_item = Cart_item::where('cart_id',$cart->id)->get();
        $subtotal = Cart_item::where('cart_id',$cart->id)->sum('total');
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

    public function loadQtyCart(Request $request)
    {
        $userId = Auth::user()->id;
        $cart = Cart::where('user_id',  $userId)->first();
        $qty = $cart->cart_item->sum('quantity');

        echo('<div class="tip" id="tip_cart">'.$qty.'</div>');
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
            $coupon_id = Session::get('coupon')[0]['id'];
            $coupon = Coupon::find($coupon_id);
            $coupon->quantity = $coupon->quantity -1;
            if ($coupon->quantity < 0) {
                // $coupon->delete();
            }else{
                // $coupon->save();
            }
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
            $order->total = $request->total + $order->tax + $order->shipping;
            $order->name = $address->name;
            $order->coupon_id = $coupon_id;
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
                $size = Product_size::where('name',$data->size)->first();
                $color = Product_color::where('name',$data->color)->first();
                $stock = product_stock::where('color_id',$color->id)->where('size_id',$size->id)->where('product_id',$data->product_id)->first();
                $stock->quantity = $stock->quantity - $data->quantity;
                $stock->save();
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
//---------------------------------------------------- Coupon----------
    public function checkCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();
        if ($coupon) {
            $coupon_session = Session::get('coupon');
            // if($coupon_session){
                $cou[] =array(
                    'id' =>$coupon->id,
                    'code' =>$coupon->code,
                    'condition' =>$coupon->condition,
                    'number' =>$coupon->number
                );
                Session::put('coupon',$cou);
            // }
            Session::save();
            return redirect()->back();
        }else{
            return redirect()->back();
        }

    }
}
