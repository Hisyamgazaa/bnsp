<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Checkout') }}
    </h2>
  </x-slot>

  <div class="py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 sm:p-6 text-gray-900">
          <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Checkout</h2>

          <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <div>
                <h3 class="text-base sm:text-lg font-semibold mb-4">Informasi Pengiriman</h3>

                <div class="mb-4">
                  <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">
                    Alamat Pengiriman
                  </label>
                  <textarea name="shipping_address" id="shipping_address" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base"
                    required>{{ old('shipping_address') }}</textarea>
                </div>

                <div class="mb-4">
                  <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">
                    Nomor Telepon
                  </label>
                  <input type="text" name="phone_number" id="phone_number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base"
                    value="{{ old('phone_number') }}" required>
                </div>

                <div class="mb-4">
                  <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                    Catatan (opsional)
                  </label>
                  <textarea name="notes" id="notes" rows="2"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base">{{ old('notes') }}</textarea>
                </div>

                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-3">
                    Metode Pembayaran
                  </label>
                  <div class="space-y-2">
                    <div class="flex items-center">
                      <input type="radio" id="payment_cash" name="payment_method" value="cash"
                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300"
                        {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }} required>
                      <label for="payment_cash" class="ml-3 block text-sm font-medium text-gray-700">
                        💵 Cash (Bayar di Tempat)
                      </label>
                    </div>
                    <div class="flex items-center">
                      <input type="radio" id="payment_transfer" name="payment_method" value="transfer"
                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300"
                        {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                      <label for="payment_transfer" class="ml-3 block text-sm font-medium text-gray-700">
                        🏦 Transfer Bank
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div>
                <h3 class="text-base sm:text-lg font-semibold mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-4">
                  @foreach($cartItems as $item)
                  <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
                    @if($item->product->image)
                      @if(Str::startsWith($item->product->image, ['http://', 'https://']))
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                      @else
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                      @endif
                    @else
                      <img src="{{ asset('images/placeholder.svg') }}" alt="No image" class="w-16 h-16 object-cover rounded-md bg-gray-100 flex-shrink-0">
                    @endif

                    <div class="flex-1 min-w-0">
                      <h4 class="font-medium text-sm sm:text-base truncate">{{ $item->product->name }}</h4>
                      <p class="text-xs sm:text-sm text-gray-600">
                        {{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}
                        <span class="text-xs text-gray-500 block sm:inline">(Stok tersedia: {{ $item->product->stock }})</span>
                      </p>
                    </div>

                    <div class="text-left sm:text-right">
                      <p class="font-medium text-sm sm:text-base">
                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                      </p>
                    </div>
                  </div>
                  @endforeach

                  <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between items-center text-base sm:text-lg font-semibold">
                      <span>Total</span>
                      <span>Rp {{ number_format($cartItems->sum(function($item) {
                                                return $item->product->price * $item->quantity;
                                            }), 0, ',', '.') }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-end">
              <button type="submit" class="w-full sm:w-auto bg-blue-500 text-white px-6 py-2 sm:py-3 rounded-md hover:bg-blue-600 transition-colors duration-300 text-sm sm:text-base font-medium">
                Buat Pesanan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
