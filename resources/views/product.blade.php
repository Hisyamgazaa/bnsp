<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Products') }}
    </h2>
  </x-slot>

  <div class="py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="mb-4 p-3 sm:p-4 bg-green-100 border border-green-400 text-green-700 rounded text-sm sm:text-base">
        {{ session('success') }}
      </div>
      @endif

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 sm:p-6 text-gray-900">
          <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Produk Alat Kesehatan</h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
              @if($product->image)
                @if(Str::startsWith($product->image, ['http://', 'https://']))
                  <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-40 sm:h-48 object-cover">
                @else
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 sm:h-48 object-cover">
                @endif
              @else
                <img src="{{ asset('images/placeholder.svg') }}" alt="No image" class="w-full h-40 sm:h-48 object-cover bg-gray-100">
              @endif
              <div class="p-3 sm:p-4">
                <h3 class="text-base sm:text-lg font-semibold mb-2 line-clamp-2">{{ $product->name }}</h3>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 sm:mb-4 gap-1 sm:gap-0">
                  <span class="text-blue-600 font-semibold text-sm sm:text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                  <span class="text-xs sm:text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                </div>
                <div class="mb-3 sm:mb-4">
                  <span class="inline-block bg-gray-100 rounded-full px-2 py-1 sm:px-3 text-xs sm:text-sm font-semibold text-gray-600">
                    {{ $product->category->name ?? $product->category }}
                  </span>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2">
                  <a href="{{ route('product.show', $product->id) }}" class="block w-full bg-gray-100 text-gray-700 py-2 px-3 sm:px-4 rounded-md hover:bg-gray-200 transition-colors duration-300 text-center text-sm sm:text-base">
                    Lihat Detail
                  </a>

                  <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @if($product->stock > 0)
                      <button type="submit" class="w-full bg-blue-500 text-white py-2 px-3 sm:px-4 rounded-md hover:bg-blue-600 transition-colors duration-300 text-sm sm:text-base">
                        Tambah ke Keranjang
                      </button>
                    @else
                      <button type="button" disabled class="w-full bg-gray-400 text-white py-2 px-3 sm:px-4 rounded-md cursor-not-allowed text-sm sm:text-base">
                        Stok Habis
                      </button>
                    @endif
                  </form>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="mt-4 sm:mt-6">
            {{ $products->links('pagination::tailwind') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
