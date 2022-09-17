<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function listOrder()
    {
        $order = Order::all();
        return view('admin.pages.order.listOrder',compact('order'));
    }
    public function viewOrder($id)
    {
        $order = Order::find($id);
        $transaction = Transaction::where('order_id',$order->id)->first();
        // $subtotal = Cart_item::where('cart_id',$order->id)->sum('total');
        $order_item = Order_item::where('order_id',$order->id)->get();
        return view('admin.pages.order.viewOrder',compact('order_item','order','transaction'));
    }
    public function updateOrderStatus($id, Request $reuqest)
    {
        // echo($id);
        $order = Order::find($id);
        $order->status = $reuqest->status;
        $order->save();
        return 'success';
    }
}
