<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Product Detail') }}
    </h2>
  </x-slot>

  <div class="py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="mb-4 p-3 sm:p-4 bg-green-100 border border-green-400 text-green-700 rounded text-sm sm:text-base">
        {{ session('success') }}
      </div>
      @endif

      @if (session('error'))
      <div class="mb-4 p-3 sm:p-4 bg-red-100 border border-red-400 text-red-700 rounded text-sm sm:text-base">
        {{ session('error') }}
      </div>
      @endif

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 sm:p-6 text-gray-900">
          <!-- Breadcrumb -->
          <nav class="mb-4 sm:mb-6">
            <ol class="flex items-center space-x-2 text-xs sm:text-sm">
              <li><a href="{{ route('product') }}" class="text-blue-600 hover:text-blue-800">Products</a></li>
              <li class="text-gray-500">/</li>
              <li class="text-gray-700 truncate">{{ $product->name }}</li>
            </ol>
          </nav>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
            <!-- Product Image -->
            <div class="space-y-4">
              <div class="aspect-square w-full max-w-sm sm:max-w-md mx-auto">
                @if($product->image)
                  @if(Str::startsWith($product->image, ['http://', 'https://']))
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg shadow-md">
                  @else
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg shadow-md">
                  @endif
                @else
                  <img src="{{ asset('images/placeholder.svg') }}" alt="No image" class="w-full h-full object-cover bg-gray-100 rounded-lg shadow-md">
                @endif
              </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-4 sm:space-y-6">
              <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2 sm:mb-3">{{ $product->name }}</h1>
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 mb-3 sm:mb-4">
                  <span class="text-xl sm:text-2xl font-semibold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                  <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs sm:text-sm font-semibold text-gray-600">
                    {{ $product->category->name ?? $product->category }}
                  </span>
                </div>
              </div>

              <!-- Stock Information -->
              <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
                <div class="flex items-center justify-between">
                  <span class="text-sm sm:text-base text-gray-700 font-medium">Stok Tersedia:</span>
                  <span class="text-base sm:text-lg font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->stock }}
                  </span>
                </div>
              </div>

              <!-- Description -->
              @if($product->description)
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
              </div>
              @endif

              <!-- Add to Cart Form -->
              <div class="space-y-4">
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                  <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                      Jumlah
                    </label>
                    <div class="flex items-center space-x-3">
                      <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $product->stock }}"
                        class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        {{ $product->stock <= 0 ? 'disabled' : '' }}
                      >
                      <span class="text-sm text-gray-500">dari {{ $product->stock }} tersedia</span>
                    </div>
                  </div>

                  <div class="flex space-x-3">
                    @if($product->stock > 0)
                      <button type="submit" class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 transition-colors duration-300 font-medium">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 9H19"></path>
                        </svg>
                        Tambah ke Keranjang
                      </button>
                    @else
                      <button type="button" disabled class="flex-1 bg-gray-400 text-white py-3 px-6 rounded-md cursor-not-allowed font-medium">
                        Stok Habis
                      </button>
                    @endif

                    <a href="{{ route('product') }}" class="bg-gray-200 text-gray-700 py-3 px-6 rounded-md hover:bg-gray-300 transition-colors duration-300 font-medium">
                      Kembali
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
