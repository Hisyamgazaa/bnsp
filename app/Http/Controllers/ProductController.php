<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
  {
    $products = Product::where('stock', '>', 0)->paginate(8);
    return view('product', compact('products'));
  }

  public function show($id)
  {
    $product = Product::where('id', $id)->where('stock', '>', 0)->firstOrFail();
    return view('product-detail', compact('product'));
  }
}
