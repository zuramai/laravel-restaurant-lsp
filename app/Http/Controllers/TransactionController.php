<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Order;
use Auth;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $transactions = Transaction::orderBy('id','desc')->paginate(10);
        $orders = Order::where('status_order', 'Processing')->orderBy('id','asc')->paginate(10);        
        return view('transaction.index', compact('orders', 'transactions'));
    }

    public function show(Request $request, $order_id) {
        $order = Order::findOrFail($order_id);
        return view('transaction.detail', compact('order'));
    }

    public function finish(Request $request, $order_id) {
        $request->validate([
            'jumlah_bayar' => 'required|integer|min:85000'
        ]);

        $order = Order::find($order_id);

        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->total_harga = $order->total_price;
        $transaction->total_bayar = $request->jumlah_bayar;
        $transaction->save();

        $order->status_order = "Success";
        $order->save();

        session()->flash('success','Sukses Menyelesaikan Pemesanan ID '.$order->id);
        return redirect()->back();
    }
}
