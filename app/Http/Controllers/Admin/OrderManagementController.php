<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(): View
    {
        $orders = Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order): View
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Delete an order
     */
    public function destroy(Order $order): RedirectResponse
    {
        // Delete order items first
        $order->items()->delete();
        
        // Delete the order
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
