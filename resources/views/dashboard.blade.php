@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<!-- Import Font Awesome & Google Font Inter -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc;
        color: #334155;
    }
    .card-dashboard {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.05);
    }
    .icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
    .section-title {
        font-size: 0.825rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #64748b;
        text-transform: uppercase;
    }
    .table-custom th {
        background-color: #f1f5f9;
        color: #475569;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 600;
        padding-top: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-custom td {
        padding: 14px 16px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    .badge-soft-warning {
        background-color: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    .badge-soft-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    .badge-soft-neutral {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }
    .badge-soft-success {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }
</style>

<div class="container py-4">

    <div class="mb-4 pb-2 border-bottom">
        <h1 class="h4 fw-semibold mb-1">Dashboard</h1>
        <p class="text-muted small mb-0">
            Ringkasan Hari Ini — {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
        </p>
    </div>

    <div class="row g-3">
        @can('viewAny', App\Models\User::class)
        <div class="col-12">
            <h6 class="fw-semibold text-muted text-uppercase small mb-2">Today's Sale</h6>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                         style="width: 44px; height: 44px; background-color:#eef2ff;">
                        <i class="bi bi-cash-stack text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase mb-1">Total Nilai Penjualan Hari Ini</div>
                        <div class="fs-5 fw-semibold">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                         style="width: 44px; height: 44px; background-color:#eef2ff;">
                        <i class="bi bi-card-text text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase mb-1">Jumlah Transaksi Hari Ini</div>
                        <div class="fs-5 fw-semibold">{{ $ringkasan['total_transaksi'] }}</div>
        <!-- SECTION 2: CASH & PAYMENT STATUS -->
        <div class="mb-5">
            <h6 class="section-title mb-3">
                <i class="fas fa-credit-card me-2"></i>Cash & Payment Status
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card card-dashboard h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium">Total Pembayaran Tunai</span>
                                <h4 class="fw-bold mb-0 mt-2" style="color: #1e293b;">
                                    Rp {{ number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.') }}
                                </h4>
                            </div>
                            <div class="icon-box" style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                                <i class="fas fa-money-bill-wave fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-dashboard h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium">Total Pembayaran Non-Tunai</span>
                                <h4 class="fw-bold mb-0 mt-2" style="color: #1e293b;">
                                    Rp {{ number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.') }}
                                </h4>
                            </div>
                            <div class="icon-box" style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                                <i class="fas fa-receipt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <h6 class="fw-semibold text-muted text-uppercase small mb-2">Cash & Payment Status</h6>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                         style="width: 44px; height: 44px; background-color:#ecfdf5;">
                        <i class="bi bi-wallet2 text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase mb-1">Total Pembayaran Tunai</div>
                        <div class="fs-5 fw-semibold">{{ $ringkasan['total_transaksi'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                         style="width: 44px; height: 44px; background-color:#ecfdf5;">
                        <i class="bi bi-credit-card text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase mb-1">Total Pembayaran Non-Tunai</div>
                        <div class="fs-5 fw-semibold">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        <div class="col-12 mt-4">
            <h6 class="fw-semibold text-muted text-uppercase small mb-2">Critical Inventory Status</h6>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3">Daftar Produk Stok Rendah</h6>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background-color:#fef3c7; color:#92400e;">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-3">Seluruh produk dalam kondisi stok aman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $produkStokRendah->links() }}
                    </div>
    @endif

    <!-- SECTION 3: CRITICAL INVENTORY STATUS -->
    <div class="mb-5">
        <h6 class="section-title mb-3">
            <i class="fas fa-boxes me-2"></i>Critical Inventory Status
        </h6>
        <div class="row g-4 align-items-stretch">
            
            <!-- Stok Rendah -->
            <div class="col-lg-6 d-flex">
                <div class="card card-dashboard w-100 d-flex flex-column overflow-hidden">
                    <div class="px-4 py-3 bg-white border-bottom d-flex align-items-center">
                        <h6 class="fw-semibold mb-0" style="color: #334155;">Daftar Produk Stok Rendah</h6>
                    </div>

                    <div class="card-body p-0 flex-grow-1">
                        <div class="table-responsive h-100">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th width="12%" class="text-center">#</th>
                                        <th>Nama Produk</th>
                                        <th width="30%" class="text-center">Stok Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="text-center fw-semibold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="fw-medium">{{ $produk->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-soft-warning px-3 py-1 rounded-pill">
                                                    {{ $produk->stok }} Unit
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-5">
                                                <i class="fas fa-check-circle text-muted fa-2x mb-2 d-block opacity-50"></i>
                                                <span class="small">Seluruh produk berada dalam kondisi stok aman.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(isset($produkStokRendah) && $produkStokRendah->hasPages())
                        <div class="card-footer bg-white border-top py-2 px-3">
                            {{ $produkStokRendah->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3">Produk Habis Stok</h6>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background-color:#fee2e2; color:#991b1b;">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-3">Seluruh produk dalam kondisi stok aman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $produkStokHabis->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <h6 class="fw-semibold text-muted text-uppercase small mb-2">Best Seller Produk</h6>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th scope="col" class="ps-3">Nama</th>
                                    <th scope="col" class="text-center">Stok</th>
                                    <th scope="col" class="text-center">Unit Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                <tr>
                                    <td class="ps-3 fw-medium">{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background-color:#f1f5f9; color:#475569;">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background-color:#ecfdf5; color:#065f46;">
                                            {{ $produk->total_terjual }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-3">
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
            <!-- Produk Habis -->
            <div class="col-lg-6 d-flex">
                <div class="card card-dashboard w-100 d-flex flex-column overflow-hidden">
                    <div class="px-4 py-3 bg-white border-bottom d-flex align-items-center">
                        <h6 class="fw-semibold mb-0" style="color: #334155;">Produk Habis Stok</h6>
                    </div>

                    <div class="card-body p-0 flex-grow-1">
                        <div class="table-responsive h-100">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th width="12%" class="text-center">#</th>
                                        <th>Nama Produk</th>
                                        <th width="30%" class="text-center">Stok Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="text-center fw-semibold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="fw-medium">{{ $produk->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-soft-danger px-3 py-1 rounded-pill">
                                                    0 Unit
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-5">
                                                <i class="fas fa-check-circle text-muted fa-2x mb-2 d-block opacity-50"></i>
                                                <span class="small">Tidak ada produk yang habis stok.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(isset($produkStokHabis) && $produkStokHabis->hasPages())
                        <div class="card-footer bg-white border-top py-2 px-3">
                            {{ $produkStokHabis->links() }}
                        </div>
                    @endif
>>>>>>> Stashed changes
                </div>
            </div>

        </div>

<<<<<<< Updated upstream
=======
    <!-- SECTION 4: BEST SELLER PRODUCTS -->
    <div class="mb-4">
        <h6 class="section-title mb-3">
            <i class="fas fa-fire me-2"></i>Best Seller Products
        </h6>
        <div class="card card-dashboard overflow-hidden">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th class="text-center" width="20%">Stok Tersisa</th>
                            <th class="text-center" width="25%">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td class="fw-semibold">{{ $produk->nama }}</td>
                                <td class="text-center">
                                    <span class="badge badge-soft-neutral px-3 py-1 rounded-pill">
                                        {{ $produk->stok }} Unit
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-soft-success px-3 py-1 rounded-pill fw-bold">
                                        {{ number_format($produk->total_terjual) }} Terjual
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center py-5">
                                    <i class="fas fa-box-open text-muted fa-2x mb-2 d-block opacity-50"></i>
                                    <span class="small">Belum ada data penjualan produk.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
>>>>>>> Stashed changes
    </div>
</div>

@endsection