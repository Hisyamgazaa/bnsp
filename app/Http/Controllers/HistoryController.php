<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
  public function index()
  {
    $orders = Order::where('user_id', Auth::id())
      ->orderBy('created_at', 'desc')
      ->get();

    return view('history', compact('orders'));
  }

  public function show(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403);
    }

    return view('history-detail', compact('order'));
  }
}
