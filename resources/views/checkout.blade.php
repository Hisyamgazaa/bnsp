<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Checkout') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h2 class="text-2xl font-semibold mb-6">Checkout</h2>

          <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h3 class="text-lg font-semibold mb-4">Informasi Pengiriman</h3>

                <div class="mb-4">
                  <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">
                    Alamat Pengiriman
                  </label>
                  <textarea name="shipping_address" id="shipping_address" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>{{ old('shipping_address') }}</textarea>
                </div>

                <div class="mb-4">
                  <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">
                    Nomor Telepon
                  </label>
                  <input type="text" name="phone_number" id="phone_number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{ old('phone_number') }}" required>
                </div>

                <div class="mb-4">
                  <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                    Catatan (opsional)
                  </label>
                  <textarea name="notes" id="notes" rows="2"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                </div>
              </div>

              <div>
                <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-4">
                  @foreach($cartItems as $item)
                  <div class="flex items-center gap-4">
                    @if($item->product->image)
                      @if(Str::startsWith($item->product->image, ['http://', 'https://']))
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md">
                      @else
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md">
                      @endif
                    @else
                      <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-md">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                      </div>
                    @endif

                    <div class="flex-1">
                      <h4 class="font-medium">{{ $item->product->name }}</h4>
                      <p class="text-sm text-gray-600">
                        {{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}
                      </p>
                    </div>

                    <div class="text-right">
                      <p class="font-medium">
                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                      </p>
                    </div>
                  </div>
                  @endforeach

                  <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between items-center text-lg font-semibold">
                      <span>Total</span>
                      <span>Rp {{ number_format($cartItems->sum(function($item) {
                                                return $item->product->price * $item->quantity;
                                            }), 0, ',', '.') }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-8 flex justify-end">
              <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">
                Buat Pesanan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
