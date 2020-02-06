<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Masakan;
use App\Meja;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request) {
        $masakans = Masakan::where('status',1)->get();
        $mejas = Meja::all();
        $orders = Order::orderBy('id','desc')->where('user_id', Auth::user()->id)->paginate(10);
        return view('order.index', compact('orders', 'masakans','mejas'));
    }

    public function new(Request $request) {
        $totalPrice = 0;
        foreach($request->pesanans as $pesanan) {
            $totalPrice += $pesanan['totalPrice'];
        }

        $order = new Order;
        $order->user_id = $request->user_id;
        $order->meja_id = $request->meja_id;
        $order->total_price = $totalPrice;
        $order->keterangan = '';
        $order->status_order = "Processing";
        $order->save();
        foreach($request->pesanans as $pesanan) {
           
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->masakan_id = $pesanan['id'];
            $orderDetail->keterangan = '';
            $orderDetail->quantity = $pesanan['quantity'];
            $orderDetail->price = $pesanan['totalPrice'];
            $orderDetail->status = 'Success';
            $orderDetail->save();
        }

        return response()->json(['success' => true]);
    }
}
