<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CheckoutController extends Controller
{
  public function checkout()
  {
    $cartItems = CartItem::where('user_id', Auth::id())
      ->with('product')
      ->get();

    if ($cartItems->isEmpty()) {
      return redirect()->route('cart')->with('error', 'Keranjang belanja Anda kosong');
    }

    return view('checkout', compact('cartItems'));
  }

  public function process(Request $request)
  {
    $request->validate([
      'shipping_address' => 'required|string',
      'phone_number' => 'required|string',
      'payment_method' => 'required|in:cash,transfer',
      'notes' => 'nullable|string'
    ]);

    $cartItems = CartItem::where('user_id', Auth::id())
      ->with('product')
      ->get();

    if ($cartItems->isEmpty()) {
      return redirect()->route('cart')->with('error', 'Keranjang belanja Anda kosong');
    }

    $totalAmount = $cartItems->sum(function ($item) {
      return $item->product->price * $item->quantity;
    });

    $order = Order::create([
      'user_id' => Auth::id(),
      'total_amount' => $totalAmount,
      'shipping_address' => $request->shipping_address,
      'phone_number' => $request->phone_number,
      'payment_method' => $request->payment_method,
      'notes' => $request->notes
    ]);

    foreach ($cartItems as $item) {
      OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $item->product_id,
        'quantity' => $item->quantity,
        'price' => $item->product->price
      ]);
    }

    // Clear the cart
    CartItem::where('user_id', Auth::id())->delete();

    return redirect()->route('checkout.success', $order)->with('success', 'Pesanan berhasil dibuat');
  }

  public function success(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403);
    }

    return view('checkout-success', compact('order'));
  }

  public function invoice(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403);
    }

    $pdf = PDF::loadView('invoice', compact('order'));

    return $pdf->download('Invoice-' . $order->order_number . '.pdf');
  }
}
