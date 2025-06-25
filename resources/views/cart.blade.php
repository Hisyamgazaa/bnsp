<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Shopping Cart') }}
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
          <h2 class="text-2xl font-semibold mb-6">Keranjang Belanja</h2>

          @if($cartItems->isEmpty())
          <div class="text-center py-8">
            <p class="text-gray-500 text-lg">Keranjang belanja Anda masih kosong</p>
            <a href="{{ route('product') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
              Lihat Produk
            </a>
          </div>
          @else
          <div class="space-y-4">
            @foreach($cartItems as $item)
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
              @if($item->product->image)
                @if(Str::startsWith($item->product->image, ['http://', 'https://']))
                  <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-md">
                @else
                  <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-md">
                @endif
              @else
                <img src="{{ asset('images/placeholder.svg') }}" alt="No image" class="w-24 h-24 object-cover rounded-md bg-gray-100">
              @endif

              <div class="flex-1">
                <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                <p class="text-gray-600">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>

                <div class="mt-2 flex items-center gap-4">
                  <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <label for="quantity" class="text-sm text-gray-600">Jumlah:</label>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                      class="w-20 px-2 py-1 border rounded-md"
                      onchange="this.form.submit()">
                    <span class="text-xs text-gray-500 ml-1">(Maks: {{ $item->product->stock }})</span>
                  </form>

                  <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">
                      Hapus
                    </button>
                  </form>
                </div>
              </div>

              <div class="text-right">
                <p class="text-lg font-semibold">
                  Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                </p>
              </div>
            </div>
            @endforeach

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
              <div class="flex justify-between items-center text-xl font-semibold">
                <span>Total:</span>
                <span>Rp {{ number_format($cartItems->sum(function($item) {
                                        return $item->product->price * $item->quantity;
                                    }), 0, ',', '.') }}</span>
              </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
              <a href="{{ route('product') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-300">
                Lanjut Belanja
              </a> <a href="{{ route('checkout') }}" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">
                Checkout
              </a>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
