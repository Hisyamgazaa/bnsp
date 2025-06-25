@extends('admin.layout')

@section('title', 'User Details')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">User Details: {{ $user->name }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit User
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Users
                </a>
            </div>
        </div>

        <!-- User Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Basic Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Name:</span>
                        <span>{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Email:</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Role:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Email Verified:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Account Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">User ID:</span>
                        <span>#{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Created:</span>
                        <span>{{ $user->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Last Updated:</span>
                        <span>{{ $user->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                    @if($user->email_verified_at)
                    <div class="flex justify-between">
                        <span class="font-medium">Email Verified At:</span>
                        <span>{{ $user->email_verified_at->format('M d, Y H:i') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-medium">Total Orders:</span>
                        <span class="font-semibold">{{ $user->orders->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        @if($user->orders->count() > 0)
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Orders</h3>
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($user->orders->take(5) as $order)
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Order #{{ $order->id }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $order->created_at->format('M d, Y H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <div class="text-sm text-gray-500">
                                    {{ $order->orderItems->count() }} item(s)
                                </div>
                            </div>
                        </div>
                        @if($order->orderItems->count() > 0)
                        <div class="mt-2">
                            <div class="text-sm text-gray-600">
                                Items:
                                @foreach($order->orderItems->take(3) as $item)
                                    {{ $item->product->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                                @if($order->orderItems->count() > 3)
                                    and {{ $order->orderItems->count() - 3 }} more...
                                @endif
                            </div>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @if($user->orders->count() > 5)
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-500">Showing 5 of {{ $user->orders->count() }} total orders</p>
            </div>
            @endif
        </div>
        @else
        <div class="mt-8">
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.713-3.714M14 40v-4c0-1.313.253-2.566.713-3.714m0 0A10.003 10.003 0 0124 26c4.21 0 7.813 2.602 9.288 6.286M30 14a6 6 0 11-12 0 6 6 0 0112 0zm12 6a4 4 0 11-8 0 4 4 0 018 0zm-28 0a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No orders yet</h3>
                <p class="mt-1 text-sm text-gray-500">This user hasn't made any orders yet.</p>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="mt-8 flex items-center justify-between">
            <div class="flex space-x-3">
                @if($user->role !== 'admin' && $user->id !== auth()->id())
                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-{{ $user->is_active ? 'yellow' : 'green' }}-500 hover:bg-{{ $user->is_active ? 'yellow' : 'green' }}-700 text-white font-bold py-2 px-4 rounded">
                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>

                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete User
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
