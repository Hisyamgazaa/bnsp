<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Riwayat Transaksi') }}
    </h2>
  </x-slot>

  <div class="py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 sm:p-6 text-gray-900">
          <div class="overflow-x-auto">
            @if($orders->isEmpty())
            <div class="text-center py-8">
              <p class="text-gray-500 text-base sm:text-lg">Anda belum memiliki riwayat transaksi</p>
              <a href="{{ route('product') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 sm:py-3 sm:px-6 rounded-md hover:bg-blue-600 transition-colors duration-300 text-sm sm:text-base">
                Mulai Berbelanja
              </a>
            </div>
            @else
            <!-- Mobile-friendly cards on small screens -->
            <div class="block sm:hidden space-y-4">
              @foreach($orders as $order)
              <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between items-start mb-3">
                  <div>
                    <p class="font-medium text-gray-900">{{ $order->order_number }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                  </div>
                  <div class="text-right">
                    <p class="font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
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
                  </div>
                </div>
                <div class="flex gap-3">
                  <a href="{{ route('history.show', $order) }}"
                    class="flex-1 text-center bg-blue-500 text-white py-2 px-3 rounded-md hover:bg-blue-600 transition-colors text-sm">
                    Detail
                  </a>
                  <a href="{{ route('checkout.invoice', $order) }}"
                    class="flex-1 text-center bg-gray-500 text-white py-2 px-3 rounded-md hover:bg-gray-600 transition-colors text-sm">
                    Invoice
                  </a>
                </div>
              </div>
              @endforeach
            </div>

            <!-- Table view for larger screens -->
            <div class="hidden sm:block">
              <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Nomor Order
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Total
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Aksi
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach($orders as $order)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                      {{ $order->order_number }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
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
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <div class="flex items-center space-x-3">
                        <a href="{{ route('history.show', $order) }}"
                          class="text-blue-600 hover:text-blue-900">
                          Detail
                        </a>
                        <a href="{{ route('checkout.invoice', $order) }}"
                          class="text-gray-600 hover:text-gray-900">
                          Invoice
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
