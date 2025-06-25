@extends('admin.layout')

@section('title', 'Order Details')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Order #{{ $order->order_number }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Orders
                </a>
            </div>
        </div>

        <!-- Status Update Form -->
        <div class="mb-6">
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center space-x-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Update Status:</label>
                    <div class="flex items-center space-x-2">
                        <select name="status" id="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Order Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Order Details -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Order Information</h3>
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Status</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'shipped' => 'bg-purple-100 text-purple-800',
                                    'delivered' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Date</span>
                            <span>{{ $order->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Order ID</span>
                            <span>{{ $order->order_number }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Payment Method</span>
                            <span>
                                @if($order->payment_method == 'cash')
                                    💵 Cash
                                @else
                                    🏦 Transfer
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Total Amount</span>
                            <span class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Items</span>
                            <span>{{ $order->items->count() }} item(s)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
                <div class="space-y-3">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Customer</span>
                        <div class="flex items-center">
                            <span class="font-medium">{{ $order->user->name }}</span>
                            <a href="{{ route('admin.users.show', $order->user) }}" class="ml-2 text-blue-500 text-sm hover:text-blue-700">(View Profile)</a>
                        </div>
                        <span class="block text-sm text-gray-500">{{ $order->user->email }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Shipping Address</span>
                        <span>{{ $order->shipping_address }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Phone Number</span>
                        <span>{{ $order->phone_number }}</span>
                    </div>
                    @if($order->notes)
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Notes</span>
                        <span>{{ $order->notes }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
            <div class="bg-white shadow overflow-x-auto rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($item->product->image)
                                                @if(Str::startsWith($item->product->image, ['http://', 'https://']))
                                                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                                @else
                                                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                                @endif
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-gray-300 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">Total</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex items-center justify-between">
            <div class="flex space-x-3">
                <a href="{{ route('checkout.invoice', $order) }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Invoice
                </a>

                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this order? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
