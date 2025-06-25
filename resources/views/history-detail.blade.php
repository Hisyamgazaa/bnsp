<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Detail Transaksi') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="mb-6">
            <a href="{{ route('history') }}" class="text-blue-500 hover:text-blue-600">
              ← Kembali ke Riwayat
            </a>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <h3 class="text-lg font-semibold mb-4">Informasi Order</h3>
              <div class="bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <p class="text-sm text-gray-600">Nomor Order</p>
                    <p class="font-medium">{{ $order->order_number }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Tanggal</p>
                    <p class="font-medium">{{ $order->created_at->format('d M Y H:i') }}</p>
                  </div>
                  <div>

                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Total</p>
                    <p class="font-medium">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-medium">
                      @if($order->payment_method == 'cash')
                        💵 Cash (Bayar di Tempat)
                      @else
                        🏦 Transfer Bank
                      @endif
                    </p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="font-medium">
                      @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'processing' => 'bg-blue-100 text-blue-800',
                            'shipped' => 'bg-purple-100 text-purple-800',
                            'delivered' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800'
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu',
                            'processing' => 'Diproses',
                            'shipped' => 'Dikirim',
                            'delivered' => 'Selesai',
                            'cancelled' => 'Dibatalkan'
                        ];
                      @endphp
                      <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <h3 class="text-lg font-semibold mb-4">Informasi Pengiriman</h3>
              <div class="bg-gray-50 rounded-lg p-4">
                <div class="space-y-3">
                  <div>
                    <p class="text-sm text-gray-600">Alamat</p>
                    <p class="font-medium">{{ $order->shipping_address }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Nomor Telepon</p>
                    <p class="font-medium">{{ $order->phone_number }}</p>
                  </div>
                  @if($order->notes)
                  <div>
                    <p class="text-sm text-gray-600">Catatan</p>
                    <p class="font-medium">{{ $order->notes }}</p>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Detail Produk</h3>
            <div class="bg-gray-50 rounded-lg overflow-hidden">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  @foreach($order->items as $item)
                  <tr>
                    <td class="px-6 py-4">
                      <div class="flex items-center">
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-md">
                        <div class="ml-4">
                          <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      Rp {{ number_format($item->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                      Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="bg-gray-50">
                    <td colspan="3" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">Total</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                      Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

          <div class="mt-6 flex justify-end">
            <a href="{{ route('checkout.invoice', $order) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
              </svg>
              Download Invoice
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
