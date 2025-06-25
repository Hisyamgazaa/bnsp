@extends('admin.layout')

@section('title', 'Product Details')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Product Details: {{ $product->name }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Products
                </a>
            </div>
        </div>

        <!-- Product Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Product Image -->
            @if($product->image)
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Product Image</h3>
                @if(Str::startsWith($product->image, ['http://', 'https://']))
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-lg">
                @else
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-lg">
                @endif
            </div>
            @endif

            <!-- Basic Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Name:</span>
                        <span>{{ $product->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Category:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $product->category }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Price:</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Stock:</span>
                        <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="bg-gray-50 p-6 rounded-lg {{ $product->image ? '' : 'lg:col-span-2' }}">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
            </div>

            <!-- System Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Product ID:</span>
                        <span>#{{ $product->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Created:</span>
                        <span>{{ $product->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Last Updated:</span>
                        <span>{{ $product->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Analytics Section (placeholder for future implementation) -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Sales Information</h3>
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M9 17a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0116.07 12h15.86a2 2 0 011.664.89l.812 1.22A2 2 0 0036.07 15H37a2 2 0 012 2v18a2 2 0 01-2 2H11a2 2 0 01-2-2V17z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15 12a3 3 0 016 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Sales Analytics</h3>
                    <p class="mt-1 text-sm text-gray-500">Sales data and analytics will be available here.</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex items-center justify-between">
            <div class="flex space-x-3">
                <form action="{{ route('admin.products.toggle-stock', $product) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-{{ $product->stock > 0 ? 'yellow' : 'green' }}-500 hover:bg-{{ $product->stock > 0 ? 'yellow' : 'green' }}-700 text-white font-bold py-2 px-4 rounded">
                        {{ $product->stock > 0 ? 'Mark Out of Stock' : 'Restock Product' }}
                    </button>
                </form>

                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
