<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index(): View
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total_amount'),
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();
        $recent_users = User::where('role', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_users'));
    }

    /**
     * Show products management
     */
    public function products(): View
    {
        $products = Product::paginate(15);
        return view('admin.products', compact('products'));
    }


}
