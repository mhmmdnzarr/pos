@extends('layouts.app')

@section('title', 'Transaksi Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <div class="card border-0 shadow-sm rounded-3 mb-4 mt-5">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">Halaman Penjualan</h4>
                <p class="text-muted small mb-0">Riwayat transaksi penjualan dan status pembayarannya.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="row g-0">

            {{-- ================== PRODUK ================== --}}
            <div class="col-md-6 border-end">
                <div class="p-4" style="max-height:70vh; overflow-y:auto;">

                    <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari produk..."
                            onkeyup="this.form.submit()">
                    </form>

                    @foreach($products as $product)
                    <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 align-items-center mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button type="submit" class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                        alt="Gambar"
                                        class="rounded-circle border"
                                        style="width:45px; height:45px; object-fit:cover;">
                                    <div>
                                        <div class="fw-semibold">{{ $product->nama }}</div>
                                        <small class="text-muted">Rp {{ number_format($product->harga_jual) }}</small>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div class="col-3">
                            <input type="number" name="quantity" value="1" min="1"
                                    class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                        </div>

                        <div class="col-2">
                            <button type="submit" class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                        </div>
                    </form>
                    @endforeach

                </div>
            </div>

            {{-- ================== KERANJANG ================= --}}
            <div class="col-md-6">
                <div class="d-flex flex-column h-100">

                    <div class="table-responsive" style="max-height:45vh; overflow-y:auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary small text-uppercase fw-semibold">
                                <tr>
                                    <th class="ps-3 py-2">Produk</th>
                                    <th class="py-2">Harga</th>
                                    <th class="py-2" style="width:90px;">Qty</th>
                                    <th class="py-2">Subtotal</th>
                                    <th class="pe-3 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->itemPenjualan as $item)
                                <tr>
                                    <td class="ps-3">{{ $item->produk->nama }}</td>
                                    <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity"
                                                    value="{{ $item->kuantitas }}"
                                                    class="form-control form-control-sm"
                                                    onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-semibold">Rp {{ number_format($item->subtotal) }}</td>
                                    <td class="pe-3">
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Keranjang kosong
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-top mt-auto bg-light bg-opacity-50">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Total Pembayaran</span>
                            <span class="fs-5 fw-bold">Rp {{ number_format($sale->total_pembayaran) }}</span>
                        </div>

                        {{-- FORM CHECKOUT DENGAN INTERAKSI CASH & QRIS --}}
                        <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return validatePayment()">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label small text-muted">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-select" required onchange="togglePaymentFields()">
                                    <option value="">-- Pilih Pembayaran --</option>
                                    <option value="CASH">Cash</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                            </div>

                            {{-- 1. Field Nominal Bayar & Kembalian (Muncul hanya saat milih CASH) --}}
                            <div id="cash-fields" class="d-none border rounded p-3 mb-3 bg-white shadow-sm">
                                <div class="mb-2">
                                    <label class="form-label small text-muted mb-1">Nominal Tunai (Rp)</label>
                                    <input type="number" 
                                           name="cash_amount" 
                                           id="cash_amount" 
                                           class="form-control" 
                                           placeholder="Masukkan jumlah uang..."
                                           min="{{ $sale->total_pembayaran }}"
                                           oninput="calculateChange()">
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <span class="small text-muted">Kembalian:</span>
                                    <span class="fw-bold text-success" id="change-text">Rp 0</span>
                                </div>
                            </div>

                           {{-- 2. Container QRIS (Muncul hanya saat milih QRIS) --}}
<div id="qris-fields" class="d-none border rounded p-3 mb-3 bg-white shadow-sm text-center">
    <p class="small text-muted mb-2 fw-semibold">Scan QRIS untuk Pembayaran</p>
    
    {{-- Gambar QRIS Kamu --}}
    <img src="{{ asset('images/qris.png') }}" 
         alt="QRIS Pinalles Outdoor" 
         class="img-fluid rounded border p-2 bg-white" 
         style="max-width: 220px;">

    <small class="d-block text-muted mt-2" style="font-size: 0.75rem;">
        Pastikan pembeli sudah transfer sebelum menekan Checkout.
    </small>
</div>

                            <button type="submit" class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Checkout
                            </button>
                        </form>

                        @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}"
                              method="POST"
                              class="mt-2"
                              onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Batal Transaksi
                            </button>
                        </form>
                        @endcan
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- JAVASCRIPT UNTUK LOGIKA CASH & QRIS --}}
<script>
    const totalPay = {{ $sale->total_pembayaran ?? 0 }};

    function togglePaymentFields() {
        const method = document.getElementById('payment_method').value;
        const cashFields = document.getElementById('cash-fields');
        const qrisFields = document.getElementById('qris-fields');
        const cashInput = document.getElementById('cash_amount');

        if (method === 'CASH') {
            cashFields.classList.remove('d-none');
            qrisFields.classList.add('d-none');
            cashInput.setAttribute('required', 'required');
            cashInput.focus();
        } else if (method === 'QRIS') {
            qrisFields.classList.remove('d-none');
            cashFields.classList.add('d-none');
            cashInput.removeAttribute('required');
            cashInput.value = '';
            resetChangeText();
        } else {
            cashFields.classList.add('d-none');
            qrisFields.classList.add('d-none');
            cashInput.removeAttribute('required');
            cashInput.value = '';
            resetChangeText();
        }
    }

    function resetChangeText() {
        document.getElementById('change-text').className = 'fw-bold text-success';
        document.getElementById('change-text').innerText = 'Rp 0';
    }

    function calculateChange() {
        const cashInput = document.getElementById('cash_amount').value;
        const changeText = document.getElementById('change-text');
        
        const cash = parseFloat(cashInput) || 0;
        const change = cash - totalPay;

        if (cashInput === '') {
            resetChangeText();
        } else if (change >= 0) {
            changeText.className = 'fw-bold text-success';
            changeText.innerText = 'Rp ' + change.toLocaleString('id-ID');
        } else {
            changeText.className = 'fw-bold text-danger';
            changeText.innerText = 'Uang kurang (Rp ' + Math.abs(change).toLocaleString('id-ID') + ')';
        }
    }

    function validatePayment() {
        const method = document.getElementById('payment_method').value;
        const cash = parseFloat(document.getElementById('cash_amount').value) || 0;

        if (method === 'CASH' && cash < totalPay) {
            alert('Nominal pembayaran kurang dari total tagihan!');
            return false;
        }

        return confirm('Yakin ingin checkout transaksi ini?');
    }
</script>

@endsection