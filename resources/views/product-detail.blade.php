<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Product Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
      </div>
      @endif

      @if (session('error'))
      <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        {{ session('error') }}
      </div>
      @endif

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <!-- Back Button -->
          <div class="mb-6">
            <a href="{{ route('products') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              Kembali ke Daftar Produk
            </a>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="flex justify-center">
              @if($product->image)
                @if(Str::startsWith($product->image, ['http://', 'https://']))
                  <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full max-w-md h-96 object-cover rounded-lg shadow-lg">
                @else
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full max-w-md h-96 object-cover rounded-lg shadow-lg">
                @endif
              @else
                <img src="{{ asset('images/placeholder.svg') }}" alt="No image" class="w-full max-w-md h-96 object-cover rounded-lg shadow-lg bg-gray-100">
              @endif
            </div>

            <!-- Product Information -->
            <div class="space-y-6">
              <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <span class="inline-block bg-blue-100 rounded-full px-3 py-1 text-sm font-semibold text-blue-800">
                  {{ $product->category }}
                </span>
              </div>

              <div class="border-t border-gray-200 pt-4">
                <div class="flex items-center justify-between mb-4">
                  <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                  <div class="text-right">
                    <div class="text-sm text-gray-600">Stok Tersedia</div>
                    <div class="text-lg font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                      {{ $product->stock > 0 ? $product->stock . ' unit' : 'Habis' }}
                    </div>
                  </div>
                </div>

                @if($product->stock > 0)
                  <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                    <div class="flex items-center">
                      <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span class="text-green-800 font-medium">Produk tersedia</span>
                    </div>
                  </div>
                @else
                  <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-4">
                    <div class="flex items-center">
                      <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                      <span class="text-red-800 font-medium">Stok habis</span>
                    </div>
                  </div>
                @endif

                <form action="{{ route('cart.add') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  @if($product->stock > 0)
                    <button type="submit" class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors duration-300 font-semibold">
                      Tambah ke Keranjang
                    </button>
                  @else
                    <button type="button" disabled class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg cursor-not-allowed font-semibold">
                      Stok Habis
                    </button>
                  @endif
                </form>
              </div>
            </div>
          </div>

          <!-- Product Description -->
          <div class="mt-8 border-t border-gray-200 pt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi Produk</h2>
            <div class="prose max-w-none text-gray-700">
              {!! $product->description !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
