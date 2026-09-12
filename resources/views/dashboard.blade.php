<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Dashboard')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h3 fw-bold mb-1">Dashboard</h1>
            <h5 class="text-muted fw-normal fs-6 mb-0">
                Ringkasan Hari Ini 
                <span class="badge bg-primary bg-opacity-10 text-primary ms-1 px-2 py-1 align-middle">
                    <i class="bi bi-calendar3 me-1"></i>
                    ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
                </span>
            </h5>
        </div>
    </div>

    <div class="row g-4">
        @can('viewAny', App\Models\User::class)
        <div class="col-md-12 mt-4 text-center">
            <h4 class="fw-bold text-secondary mb-0">Penjualan Hari Ini</h4>
        </div>
        <!-- <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white fw-bold border-0 pt-3 pb-0 text-muted fs-7 text-uppercase">
                    Total Nilai Penjualan Hari ini
                </div>
                <div class="card-body">
                    <h3 class="card-title fw-bold mb-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                </div>
            </div>
        </div> -->

        <div class="col-md-6">
            <div class="card card-stat shadow-sm h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="fw-bold border-0 pt-3 pb-0 text-muted fs-7 text-uppercase">
                                Total Nilai Penjualan Hari Ini
                            </span>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                        </div>
                        <div class="icon-shape bg-opacity-10 text-primary fs-4">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="card card-stat shadow-sm h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="fw-bold border-0 pt-3 pb-0 text-muted fs-7 text-uppercase">
                                Jumlah Transaksi Hari Ini
                            </span>
                            <h3 class="fw-bold text-dark mb-0">{{ $ringkasan['total_transaksi'] }}</h3>
                        </div>
                        <div class="icon-shape bg-opacity-10 text-primary fs-4">
                            <i class="bi bi-card-text"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 mt-4 text-center">
            <h4 class="fw-bold text-secondary mb-0">Status Pembayaran</h4>
        </div>

        <div class="col-md-6">
            <div class="card card-stat shadow-sm h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                             <span class="fw-bold border-0 pt-3 pb-0 text-muted fs-7 text-uppercase">
                                Total Pembayaran Tunai
                            </span>  
                            <h3 class="fw-bold text-dark mb-0">{{ $ringkasan['total_transaksi'] }}</h3>
                        </div>
                        <div class="icon-shape bg-opacity-10 text-primary fs-4">
                           <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-stat shadow-sm h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="fw-bold border-0 pt-3 pb-0 text-muted fs-7 text-uppercase">
                                Total Pembayaran Non-Tunai
                            </span>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h3>
                        </div>
                        <div class="icon-shape bg-opacity-10 text-primary fs-4">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
            </div>    
        </div>   
        </div>
        @endcan

        <!-- Critical Inventory Status di Tengah -->
        <div class="col-md-12 mt-4 text-center">
            <h4 class="fw-bold text-secondary mb-0">Status Stok Kritis</h4>
        </div>
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Daftar Produk Stok Rendah</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td class="fw-semibold">{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 fw-bold">
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
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Produk Habis Stok</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                    <td class="fw-semibold">{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 fw-bold">
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

<!-- Best Seller Produk di Tengah -->
<div class="col-md-12 mt-4 text-center">
    <h4 class="fw-bold text-secondary mb-0">Produk Terlaris</h4>
</div>
<div class="col-md-12">
    <!-- Menambahkan overflow-hidden dan rounded-3 pada card -->
    <div class="card border-0 shadow-sm mb-4 rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">Nama</th>
                            <th scope="col" class="text-center">Stok</th>
                            <th scope="col" class="text-center">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $produk)
                        <tr>
                            <td class="fw-bold ps-3">{{ $produk->nama }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                    {{ $produk->stok }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fw-bold">
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
        </div>
    </div>
</div>

<!-- batas akhir isi konten -->
@endsection
