<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Products') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
      </div>
      @endif

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h2 class="text-2xl font-semibold mb-6">Produk Alat Kesehatan</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
              @if($product->image)
                @if(Str::startsWith($product->image, ['http://', 'https://']))
                  <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                @else
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                @endif
              @else
                <img src="{{ asset('images/placeholder.svg') }}" alt="No image" class="w-full h-48 object-cover bg-gray-100">
              @endif
              <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                <div class="flex items-center justify-between">
                  <span class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                  <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                </div>
                <div class="mt-4">
                  <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-600">
                    {{ $product->category }}
                  </span>
                </div>
                <form action="{{ route('cart.add') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  @if($product->stock > 0)
                    <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
                      Tambah ke Keranjang
                    </button>
                  @else
                    <button type="button" disabled class="mt-4 w-full bg-gray-400 text-white py-2 px-4 rounded-md cursor-not-allowed">
                      Stok Habis
                    </button>
                  @endif
                </form>
              </div>
            </img>
            @endforeach
          </div>
          <div class="mt-6">
            {{ $products->links('pagination::tailwind') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
