<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Invoice {{ $order->order_number }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .invoice-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .invoice-details {
      margin-bottom: 30px;
    }

    .invoice-details table {
      width: 100%;
    }

    .invoice-details td {
      padding: 5px;
    }

    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    .items-table th,
    .items-table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .items-table th {
      background-color: #f8f9fa;
    }

    .total {
      text-align: right;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="invoice-header">
    <h1>INVOICE</h1>
    <h2>{{ $order->order_number }}</h2>
  </div>

  <div class="invoice-details">
    <table>
      <tr>
        <td width="50%">
          <strong>Dari:</strong><br>
          Alat Kesehatan Store<br>
          123 Jalan Sehat<br>
          Jakarta, Indonesia<br>
          Phone: (021) 123-4567
        </td>
        <td width="50%">
          <strong>Kepada:</strong><br>
          {{ $order->user->name }}<br>
          {{ $order->shipping_address }}<br>
          Phone: {{ $order->phone_number }}
        </td>
      </tr>
      <tr>
        <td>
          <strong>Tanggal Order:</strong><br>
          {{ $order->created_at->format('d/m/Y') }}<br><br>
          <strong>Metode Pembayaran:</strong><br>
          @if($order->payment_method == 'cash')
            Cash (Bayar di Tempat)
          @else
            Transfer Bank
          @endif<br><br>
          <strong>Status Order:</strong><br>
          @php
            $statusLabels = [
                'pending' => 'Menunggu',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'delivered' => 'Selesai',
                'cancelled' => 'Dibatalkan'
            ];
          @endphp
          {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
        </td>
      </tr>
    </table>
  </div>

  <table class="items-table">
    <thead>
      <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
      <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="total">
    <h3>Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h3>
  </div>

  @if($order->notes)
  <div style="margin-top: 30px;">
    <strong>Catatan:</strong><br>
    {{ $order->notes }}
  </div>
  @endif
</body>

</html>
