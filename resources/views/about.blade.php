@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('layouts.navbar')
<div class="container my-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        
        <!-- Header / Nama Pengembang -->
        <h4 class="text-primary fw-bold mb-4">Muhammad Nazar Khoerul Akwan</h4>

        <!-- Section Tentang Perusahaan & Logo -->
        <div class="row align-items-center mb-4">
            <!-- Gambar / Logo Perusahaan -->
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Pinalles Outdoor" class="img-fluid rounded-3 shadow-sm border" style="max-height: 220px; object-fit: contain;">
            </div>

            <!-- Teks Deskripsi -->
            <div class="col-md-8">
                <h5 class="fw-bold text-dark mb-2">
                    <i class="bi bi-info-circle-fill text-primary me-2"></i>Tentang Pengembang & Project
                </h5>
                <p class="text-muted leading-relaxed">
                    Aplikasi Point of Sale (POS) ini dikembangkan oleh <strong>Muhammad Nazar Khoerul Akwan</strong>, siswa jurusan <strong>Pengembangan Perangkat Lunak dan Gim (PPLG)</strong> di SMKN 4 Tasikmalaya. Project ini dirancang sebagai bentuk penerapan kompetensi keahlian dalam rekayasa perangkat lunak, khususnya dalam membangun sistem kasir digital yang praktis, efisien, dan responsif untuk membantu operasional bisnis dan UMKM.
                </p>
            </div>
        </div>

        <!-- Detail & Teknologi -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3 border h-100">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-card-list text-primary me-2"></i>Detail Pengembang</h6>
                    <ul class="list-unstyled text-muted mb-0 small">
                        <li class="mb-2"><strong>Nama:</strong> Muhammad Nazar Khoerul Akwan</li>
                        <li class="mb-2"><strong>Kelas:</strong> 12 PPLG 2</li>
                        <li class="mb-2"><strong>Jurusan:</strong> PPLG</li>
                        <li><strong>Instansi:</strong> SMKN 4 Tasikmalaya</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3 border h-100">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-cpu text-primary me-2"></i>Teknologi & Tools</h6>
                    <ul class="list-unstyled text-muted mb-0 small">
                        <li class="mb-2"><i class="bi bi-code-slash text-primary me-2"></i><strong>Framework:</strong> Laravel 12 & PHP 8.4</li>
                        <li class="mb-2"><i class="bi bi-palette text-primary me-2"></i><strong>UI:</strong> Bootstrap & Icons</li>
                        <li class="mb-2"><i class="bi bi-hdd-network text-primary me-2"></i><strong>Server:</strong> Apache</li>
                        <li><i class="bi bi-database text-primary me-2"></i><strong>Database:</strong> MySQL</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tujuan Aplikasi -->
        <div class="p-3 bg-primary-subtle rounded-3 border border-primary-subtle mb-4">
            <h6 class="fw-bold text-primary mb-2"><i class="bi bi-bullseye me-2"></i>Tujuan Aplikasi</h6>
            <p class="text-primary-emphasis mb-0 small">
                Membantu pencatatan transaksi penjualan, pengelolaan stok barang, dan pembuatan laporan keuangan harian secara otomatis dan akurat.
            </p>
        </div>

        <!-- Hubungi Pengembang -->
        <div class="text-center mt-3">
            <p class="fw-bold text-dark mb-2">Hubungi Pengembang</p>
            <div class="d-flex justify-content-center gap-3 fs-4">
                <a href="#" class="text-danger"><i class="bi bi-envelope-fill"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-github"></i></a>
                <a href="#" class="text-primary"><i class="bi bi-instagram"></i></a>
            </div>
            <small class="text-muted d-block mt-3">© 2026 Muhammad Nazar - PPLG SMKN 4 Tasikmalaya</small>
        </div>

    </div>
</div>
@endsection