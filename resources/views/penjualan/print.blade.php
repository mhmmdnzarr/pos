<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan #{{ $sale->id }}</title>
    <style>
        body { font-family: monospace; width: 300px; margin: auto; padding: 10px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 4px 0; }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h2>STRUK PENJUALAN</h2>
        <p>No. Transaksi: #{{ $sale->id }}</p>
        <p>Tanggal: {{ $sale->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="line"></div>

    <table>
        @foreach($sale->itemPenjualan as $item)
        <tr>
            <td colspan="2"><strong>{{ $item->produk->nama }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->kuantitas }} x Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td><strong>Total:</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Metode Bayar:</td>
            <td class="text-right">{{ $sale->payment_method ?? '-' }}</td>
        </tr>
    </table>

    <div class="line"></div>
    <p class="text-center">Terima Kasih!</p>
</body>
</html>