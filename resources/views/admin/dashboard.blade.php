@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 rounded-full bg-blue-500 bg-opacity-75">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Users</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 rounded-full bg-green-500 bg-opacity-75">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Products</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_products'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 rounded-full bg-yellow-500 bg-opacity-75">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 rounded-full bg-purple-500 bg-opacity-75">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($stats['total_revenue']) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Recent Orders</h3>
        </div>
        <div class="p-6">
            @if($recent_orders->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_orders as $order)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <p class="text-sm font-medium text-gray-900">#{{ $order->id }}</p>
                                <p class="text-sm text-gray-500">{{ $order->user->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">Rp {{ number_format($order->total_amount) }}</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View all orders →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No orders yet</p>
            @endif
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Recent Users</h3>
        </div>
        <div class="p-6">
            @if($recent_users->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_users as $user)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View all users →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No users yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
