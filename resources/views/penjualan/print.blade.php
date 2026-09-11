<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan #{{ $sale->id }}</title>
    <style>
        body { 
            font-family: monospace; 
            width: 300px; 
            margin: auto; 
            padding: 10px; 
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 2px 0; font-size: 13px; }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h2 style="margin-bottom: 5px;">PINALLES OUTDOOR</h2>
        <p style="margin: 0;">No. Transaksi: #{{ $sale->id }}</p>
        <p style="margin: 0;">Tanggal: {{ $sale->created_at->format('d/m/Y H:i') }}</p>
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
            <td class="text-right">{{ $sale->metode_pembayaran ?? $sale->payment_method ?? 'CASH' }}</td>
        </tr>
        
        {{-- Tampilkan Bayar & Kembalian jika metode pembayaran CASH --}}
        @if(($sale->metode_pembayaran ?? $sale->payment_method) === 'CASH')
        <tr>
            <td>Bayar (Tunai):</td>
            <td class="text-right">Rp {{ number_format($sale->cash_amount ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembalian:</td>
            <td class="text-right">Rp {{ number_format($sale->kembalian ?? 0, 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>

    <div class="line"></div>
    <div class="text-center">
        <p style="margin: 5px 0;">Terima Kasih!</p>
        <small>Ready for Adventure</small>
    </div>
</body>
</html>