<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masakan;
use App\Meja;
use App\Order;
use App\OrderDetail;
use App\Transaction;
use App\User;

class LaporanController extends Controller
{
    public function index(Request $request) {
        $data['totalUser'] = User::count();
        $data['totalPelanggan'] = User::where('level_id', 5)->count();
        $data['totalWaiter'] = User::where('level_id', 2)->count();
        $data['totalKasir'] = User::where('level_id', 3)->count();
        $data['totalOwner'] = User::where('level_id', 4)->count();
        $data['totalAdmin'] = User::where('level_id', 1)->count();
        $data['totalMasakan'] = Masakan::count();
        $data['totalMeja'] = Meja::count();
        $data['totalOrder'] = Order::count();
        $data['totalOrderSuccess'] = Order::where('status_order','Success')->count();
        $data['totalOrderProcessing'] = Order::where('status_order','Processing')->count();
        $data['totalOrderCanceled'] = Order::where('status_order','Canceled')->count();
        $data['totalTransaction'] = Transaction::count();
        $data['totalTransactionToday'] = Transaction::where('created_at','LIKE','%'.date('Y-m-d').'%')->count();
        return view('laporan.index', compact('data'));
    }
}
