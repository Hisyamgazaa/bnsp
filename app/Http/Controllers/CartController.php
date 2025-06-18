<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index()
  {
    $cartItems = CartItem::where('user_id', Auth::id())
      ->with('product')
      ->get();

    return view('cart', compact('cartItems'));
  }

  public function addToCart(Request $request)
  {
    $product = Product::findOrFail($request->product_id);
    $existingCartItem = CartItem::where('user_id', Auth::id())
      ->where('product_id', $product->id)
      ->first();

    if ($existingCartItem) {
      $existingCartItem->increment('quantity');
    } else {
      CartItem::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => 1
      ]);
    }

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
  }
  public function removeFromCart($id)
  {
    CartItem::where('user_id', Auth::id())
      ->where('id', $id)
      ->delete();

    return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
  }
  public function updateQuantity(Request $request, $id)
  {
    $request->validate([
      'quantity' => 'required|integer|min:1'
    ]);

    CartItem::where('user_id', Auth::id())
      ->where('id', $id)
      ->update(['quantity' => $request->quantity]);

    return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui');
  }
}
