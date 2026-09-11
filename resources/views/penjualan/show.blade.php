@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

@include('layouts.navbar')

<div class="container my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Detail Transaksi #{{ $penjualan->id }}</h1>
            <p class="text-muted mb-0 small">
                {{ $penjualan->created_at->translatedFormat('d F Y, H:i') }}
            </p>
        </div>
        <div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-secondary text-uppercase small mb-3">Informasi Transaksi</h6>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">Kasir</p>
                        <p class="fw-semibold mb-0">{{ $penjualan->user->name ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">Status</p>
                        @if($penjualan->status === 'COMPLETED')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-medium">
                                Selesai
                            </span>
                        @elseif($penjualan->status === 'OPEN')
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-medium">
                                Belum Selesai
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill fw-medium">
                                {{ $penjualan->status }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <p class="text-muted small mb-1">Jenis</p>
                        <p class="fw-semibold mb-0">    
                            {{ $penjualan->itemPenjualan->pluck('produk.jenis.nama_jenis')->filter()->unique()->implode(', ') ?: '-' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">Metode Pembayaran</p>
                        <p class="fw-semibold mb-0">
                            <i class="bi bi-{{ $penjualan->metode_pembayaran === 'CASH' ? 'cash' : 'qr-code' }} me-1"></i>
                            {{ $penjualan->metode_pembayaran ?? '-' }}
                        </p>
                    </div>

                    <hr class="text-muted opacity-25">

                    <div class="mb-2">
                        <p class="text-muted small mb-1">Total Pembayaran</p>
                        <h4 class="fw-bold text-dark mb-0">
                            Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                        </h4>
                    </div>

                    {{-- DITAMBAHKAN: Hanya muncul jika pembayaran menggunakan CASH --}}
                    @if($penjualan->metode_pembayaran === 'CASH')
                    <div class="mb-2 pt-2 border-top">
                        <p class="text-muted small mb-1">Bayar (Tunai)</p>
                        <p class="fw-semibold text-primary mb-0">
                            Rp {{ number_format($penjualan->cash_amount ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-muted small mb-1">Kembalian</p>
                        <h5 class="fw-bold text-success mb-0">
                            Rp {{ number_format($penjualan->kembalian ?? (($penjualan->cash_amount ?? 0) - $penjualan->total_pembayaran), 0, ',', '.') }}
                        </h5>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Detail Item -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h6 class="fw-bold text-secondary text-uppercase small mb-0">Item Dibeli</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th class="ps-4" style="width: 5%;">#</th>
                                <th style="width: 35%;">Produk</th>
                                <th style="width: 15%;">Jenis</th>
                                <th class="text-center" style="width: 10%;">Qty</th>
                                <th class="text-end" style="width: 15%;">Harga Satuan</th>
                                <th class="text-end pe-4" style="width: 20%;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan->itemPenjualan as $item)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">
                                    {{ $item->produk->nama ?? 'Produk telah dihapus' }}
                                </td>
                                <td class="text-secondary small">
                                    {{ $item->produk->jenis->nama_jenis ?? '-' }}
                                </td>
                                <td class="text-center">{{ $item->kuantitas }}</td>
                                <td class="text-end text-muted">
                                    Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td class="text-end pe-4 fw-semibold">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Tidak ada item dalam transaksi ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="5" class="text-end fw-bold ps-4">Total Tagihan</td>
                                <td class="text-end pe-4 fw-bold text-dark">
                                    Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                                </td>
                            </tr>

                            {{-- DITAMBAHKAN: Baris tambahan untuk rincian Bayar dan Kembalian di tabel --}}
                            @if($penjualan->metode_pembayaran === 'CASH')
                            <tr class="table-light border-top-0">
                                <td colspan="5" class="text-end text-muted small ps-4">Tunai Diterima</td>
                                <td class="text-end pe-4 text-muted small">
                                    Rp {{ number_format($penjualan->cash_amount ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="table-light border-top-0">
                                <td colspan="5" class="text-end fw-bold text-success ps-4">Kembalian</td>
                                <td class="text-end pe-4 fw-bold text-success">
                                    Rp {{ number_format($penjualan->kembalian ?? (($penjualan->cash_amount ?? 0) - $penjualan->total_pembayaran), 0, ',', '.') }}
                                </td>
                            </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer bg-white border-top py-3 px-4 text-end">
                    <a href="{{ route('penjualan.print', $penjualan) }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-2">
                        <i class="bi bi-printer"></i>
                        <span>Cetak Struk</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection