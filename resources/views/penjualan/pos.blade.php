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

                        <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return confirm('Yakin ingin checkout?')">
                            @csrf
                            @method('PUT')
                            <select name="payment_method" class="form-select mb-2" required>
                                <option value="">Pilih Pembayaran</option>
                                <option value="CASH">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>

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
@endsection
