<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Order Success') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="text-center">
            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>

            <h2 class="mt-4 text-2xl font-semibold">Pesanan Berhasil!</h2>
            <p class="mt-2 text-gray-600">Nomor Pesanan: {{ $order->order_number }}</p>

            <div class="mt-8">
              <a href="{{ route('checkout.invoice', $order) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Download Invoice
              </a>
            </div>

            <div class="mt-8">
              <a href="{{ route('product') }}" class="text-blue-500 hover:text-blue-600">
                ← Kembali ke Produk
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>