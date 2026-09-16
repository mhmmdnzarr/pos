@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('layouts.navbar')

<style>
    .about-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 1rem 1rem 0 0;
        padding: 2.5rem 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .about-hero h4 {
        color: #fff !important;
        font-size: 1.75rem;
    }
    .about-hero .subtitle {
        opacity: 0.85;
        font-size: 0.95rem;
    }
    .logo-wrapper {
        background: #fff;
        border-radius: 1rem;
        padding: 1rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        transition: transform 0.25s ease;
    }
    .logo-wrapper:hover {
        transform: translateY(-4px);
    }
    .info-card {
        border-radius: 1rem;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }
    .info-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }
    .tech-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 2rem;
        padding: 0.35rem 0.85rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: #495057;
        margin: 0.2rem;
    }
    .social-icon {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f1f3f5;
        transition: all 0.25s ease;
        font-size: 1.1rem;
    }
    .social-icon:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    }
    .social-icon.mail:hover { background: #dc3545; color: #fff !important; }
    .social-icon.github:hover { background: #212529; color: #fff !important; }
    .social-icon.instagram:hover {
        background: linear-gradient(45deg,#f9ce34,#ee2a7b,#6228d7);
        color: #fff !important;
    }
    .goal-card {
        background: linear-gradient(135deg, #e7f1ff 0%, #f4f8ff 100%);
        border-left: 4px solid #0d6efd;
        border-radius: 0.75rem;
    }
</style>

<div class="container my-4">
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

        <!-- Hero Header -->
        <div class="about-hero">
            <h4 class="fw-bold mb-1">Muhammad Nazar Khoerul Akwan</h4>
            <div class="subtitle">Pengembang Aplikasi &bull; Pinalles Outdoor POS</div>
        </div>

        <div class="p-4">

            <!-- Section Tentang Perusahaan & Logo -->
            <div class="row align-items-center mb-4">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="d-inline-block">
                        <img src="{{ asset('images/letet.png') }}" alt="Logo Pinalles Outdoor" class="img-fluid rounded-3" style="max-height: 200px; object-fit: contain;">
                    </div>
                </div>

                <div class="col-md-8">
                    <h5 class="fw-bold text-dark mb-2">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>Tentang Pengembang & Project
                    </h5>
                    <p class="text-muted" style="line-height: 1.7;">
                        Aplikasi Point of Sale (POS) ini dikembangkan oleh <strong>Muhammad Nazar Khoerul Akwan</strong>, siswa jurusan <strong>Pengembangan Perangkat Lunak dan Gim (PPLG)</strong> di SMKN 4 Tasikmalaya. Project ini dirancang sebagai bentuk penerapan kompetensi keahlian dalam rekayasa perangkat lunak, khususnya dalam membangun sistem kasir digital yang praktis, efisien, dan responsif untuk membantu operasional bisnis dan UMKM.
                    </p>
                </div>
            </div>

            <!-- Detail & Teknologi -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="info-card p-3 bg-light border h-100">
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
                    <div class="info-card p-3 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-cpu text-primary me-2"></i>Teknologi & Tools</h6>
                        <div>
                            <span class="tech-badge"><i class="bi bi-code-slash text-primary"></i>Laravel 12</span>
                            <span class="tech-badge"><i class="bi bi-filetype-php text-primary"></i>PHP 8.4</span>
                            <span class="tech-badge"><i class="bi bi-palette text-primary"></i>Bootstrap</span>
                            <span class="tech-badge"><i class="bi bi-hdd-network text-primary"></i>Apache</span>
                            <span class="tech-badge"><i class="bi bi-database text-primary"></i>MySQL</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tujuan Aplikasi -->
            <div class="goal-card p-3 mb-4">
                <h6 class="fw-bold text-primary mb-2"><i class="bi bi-bullseye me-2"></i>Tujuan Aplikasi</h6>
                <p class="text-primary-emphasis mb-0 small">
                    Membantu pencatatan transaksi penjualan, pengelolaan stok barang, dan pembuatan laporan keuangan harian secara otomatis dan akurat.
                </p>
            </div>

            <!-- Hubungi Pengembang -->
            <div class="text-center mt-3">
                <p class="fw-bold text-dark mb-3">Hubungi Pengembang</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="muhammadnazar0403@gmail.com" class="social-icon mail text-danger"><i class="bi bi-envelope-fill"></i></a>
                    <a href="https://github.com/mhmmdnzarr" target="_blank" class="social-icon github text-dark"><i class="bi bi-github"></i></a>
                    <a href="https://www.instagram.com/_mhmmdnzar?stkn=MThmb3gzdXY1OG5xYg==" target="_blank" class="social-icon instagram text-primary"><i class="bi bi-instagram"></i></a>
                </div>
                <small class="text-muted d-block mt-3">© 2026 Muhammad Nazar - PPLG SMKN 4 Tasikmalaya</small>
            </div>

        </div>
    </div>
</div>
@endsection