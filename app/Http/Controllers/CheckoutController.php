<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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

    // Check if all products have sufficient stock
    $stockIssues = [];

    foreach ($cartItems as $item) {
      // Re-verify stock at checkout time by fetching fresh product data
      $product = Product::find($item->product_id);

      if ($item->quantity > $product->stock) {
        $stockIssues[] = 'Produk "' . $product->name . '" tidak memiliki stok yang cukup. Anda ingin memesan ' . $item->quantity . ', sedangkan stok tersedia hanya ' . $product->stock . '.';
      }
    }

    if (!empty($stockIssues)) {
      return redirect()->route('cart')->with('error', implode('<br>', $stockIssues));
    }

    $totalAmount = $cartItems->sum(function ($item) {
      return $item->product->price * $item->quantity;
    });

    // Begin a database transaction for order creation and stock updates
    \DB::beginTransaction();

    try {
      $order = Order::create([
        'user_id' => Auth::id(),
        'total_amount' => $totalAmount,
        'shipping_address' => $request->shipping_address,
        'phone_number' => $request->phone_number,
        'payment_method' => $request->payment_method,
        'notes' => $request->notes,
        'status' => 'pending'
      ]);

      foreach ($cartItems as $item) {
        // Create order item
        OrderItem::create([
          'order_id' => $order->id,
          'product_id' => $item->product_id,
          'quantity' => $item->quantity,
          'price' => $item->product->price
        ]);

        // Reduce product stock
        $item->product->decrement('stock', $item->quantity);
      }

      // Clear the cart
      CartItem::where('user_id', Auth::id())->delete();

      \DB::commit();

      return redirect()->route('checkout.success', $order)->with('success', 'Pesanan berhasil dibuat');
    } catch (\Exception $e) {
      \DB::rollBack();
      return redirect()->route('cart')->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
    }
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
    // Allow access for admin users (role = admin) or the order owner
    if (!Auth::user()->isAdmin() && $order->user_id !== Auth::id()) {
      abort(403);
    }

    $pdf = PDF::loadView('invoice', compact('order'));

    return $pdf->download('Invoice-' . $order->order_number . '.pdf');
  }
}
