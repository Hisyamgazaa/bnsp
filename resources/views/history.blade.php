<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Riwayat Transaksi') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="overflow-x-auto">
            @if($orders->isEmpty())
            <div class="text-center py-8">
              <p class="text-gray-500 text-lg">Anda belum memiliki riwayat transaksi</p>
              <a href="{{ route('product') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
                Mulai Berbelanja
              </a>
            </div>
            @else
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
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
