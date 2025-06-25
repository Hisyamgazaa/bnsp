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

    // Check if product is in stock
    if ($product->stock <= 0) {
      return redirect()->back()->with('error', 'Produk tidak tersedia (stok habis)');
    }

    $existingCartItem = CartItem::where('user_id', Auth::id())
      ->where('product_id', $product->id)
      ->first();

    if ($existingCartItem) {
      // Check if incrementing quantity would exceed available stock
      if ($existingCartItem->quantity + 1 > $product->stock) {
        return redirect()->back()->with('error', 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
      }

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

    $cartItem = CartItem::where('user_id', Auth::id())->where('id', $id)->first();

    if (!$cartItem) {
      return redirect()->back()->with('error', 'Item tidak ditemukan');
    }

    $product = Product::find($cartItem->product_id);

    // Check if the requested quantity exceeds available stock
    if ($request->quantity > $product->stock) {
      return redirect()->back()->with('error', 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
    }

    $cartItem->update(['quantity' => $request->quantity]);

    return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui');
  }
}
