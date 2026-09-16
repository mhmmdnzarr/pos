<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Tentang')

<!-- batas awal isi konten -->
@section('content')

    @include('layouts.navbar')

    <style>
        .tentang-card {
            background-color: #2a364f;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .tentang-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, 0.35) !important;
            border-color: rgba(255, 255, 255, 0.18);
        }

        .tentang-hero {
            background: linear-gradient(135deg, #2a364f 0%, #1c2536 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .tentang-icon-wrap {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
        }

        .tentang-divider {
            width: 48px;
            height: 3px;
            border-radius: 999px;
            margin-bottom: 1rem;
        }
    </style>

    <div class="container my-5">

        <!-- Hero / Header Section -->
        <div class="p-5 mb-5 rounded-4 text-center text-white shadow-lg tentang-hero">
            {{-- Logo perusahaan: ganti 'logo.png' sesuai nama file yang kamu taruh di folder public/images/ --}}
            <img src="{{ asset('images/logo.png') }}" alt="Logo Pinalles Outdoor" class="mb-3"
                style="height: 80px; width: auto; object-fit: contain;">

            <span class="badge rounded-pill text-bg-warning-subtle text-warning-emphasis fw-semibold mb-3 px-3 py-2">
                <i class="bi bi-tree-fill me-1"></i>Outdoor Gear Specialist
            </span>
            <h1 class="display-5 fw-bold text-warning mb-3">Pinalles Outdoor</h1>
            <p class="col-lg-7 col-md-9 fs-5 mx-auto text-light opacity-75 mb-0">
                Solusi lengkap dan terpercaya untuk kebutuhan jual-beli serta penyewaan perlengkapan
                <i>camping</i> dan <i>trekking</i>.
            </p>
        </div>

        <!-- Section Foto Perusahaan/Toko & Tentang Kami -->
        <div class="row align-items-stretch g-4 mb-4">
            <div class="col-lg-5">
                {{-- Foto perusahaan/toko: ganti 'toko.jpg' sesuai nama file yang kamu taruh di folder public/images/ --}}
                <div class="h-100 rounded-4 overflow-hidden shadow-sm tentang-card" style="min-height: 260px;">
                    <img src="{{ asset('images/toko.png') }}" alt="Foto Pinalles Outdoor Store" class="w-100 h-100"
                        style="object-fit: cover;">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="h-100 p-4 p-lg-5 text-white rounded-4 shadow-sm tentang-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="tentang-icon-wrap">
                            <i class="bi bi-info-circle-fill text-info fs-5"></i>
                        </span>
                        <h3 class="fw-bold mb-0 text-info">Tentang Kami</h3>
                    </div>
                    <div class="tentang-divider bg-info"></div>
                    <p class="text-light opacity-75 mb-0 lh-lg">
                        <strong class="text-white">Pinalles Outdoor</strong> adalah penyedia perlengkapan luar ruangan
                        (<i>outdoor</i>) yang berfokus pada kemudahan akses petualangan bagi para pendaki dan pecinta alam.
                        Kami menyediakan layanan <strong class="text-white">penjualan</strong> perlengkapan baru serta
                        <strong class="text-white">penyewaan</strong> alat-alat pendakian yang terawat, higienis, dan siap
                        pakai.
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Layanan Utama -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="h-100 p-4 p-lg-5 text-white rounded-4 shadow-sm tentang-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="tentang-icon-wrap">
                            <i class="bi bi-gear-fill text-success fs-5"></i>
                        </span>
                        <h3 class="fw-bold mb-0 text-success">Layanan Utama</h3>
                    </div>
                    <div class="tentang-divider bg-success"></div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="d-flex">
                                <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                <span class="text-light opacity-75">
                                    <strong class="text-white d-block mb-1">Penyewaan Alat Outdoor</strong>
                                    Tenda, <i>carrier</i>, <i>sleeping bag</i>, kompor portable, dan matras.
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                <span class="text-light opacity-75">
                                    <strong class="text-white d-block mb-1">Penjualan Peralatan</strong>
                                    Menjual <i>gear</i> pendakian dan perlengkapan <i>camping</i> berkualitas.
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                <span class="text-light opacity-75">
                                    <strong class="text-white d-block mb-1">Kualitas & Kebersihan Terjamin</strong>
                                    Semua alat yang disewakan melalui proses pembersihan dan pengecekan kelayakan.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Lokasi -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 p-lg-5 text-white rounded-4 shadow-sm tentang-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="tentang-icon-wrap">
                            <i class="bi bi-geo-alt-fill text-warning fs-5"></i>
                        </span>
                        <h3 class="fw-bold mb-0 text-warning">Lokasi Toko</h3>
                    </div>
                    <div class="tentang-divider bg-warning"></div>
                    <p class="mb-2 fw-semibold">Pinalles Outdoor Store</p>
                    <p class="text-light opacity-75 mb-0 lh-lg">
                        Jl. Cipamokolan No.58, Cipamokolan, Kec. Rancasari, Kota Bandung, Jawa Barat 40292
                    </p>
                </div>
            </div>
        </div>

        <!-- Section Kontak (terpisah) -->
        <div class="row">
            <div class="col-12">
                <div class="p-4 p-lg-5 text-white rounded-4 shadow-sm tentang-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="tentang-icon-wrap">
                            <i class="bi bi-telephone-fill text-danger fs-5"></i>
                        </span>
                        <h3 class="fw-bold mb-0 text-danger">Hubungi Kami</h3>
                    </div>
                    <div class="tentang-divider bg-danger"></div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-facebook text-primary me-3 fs-4"></i>
                                <span class="text-light opacity-75"><strong class="text-white d-block">Facebook</strong>PINALES OUTDOOR</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill text-primary me-3 fs-4"></i>
                                <span class="text-light opacity-75"><strong
                                        class="text-white d-block">Email</strong>info@pinallesoutdoor.com</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-instagram text-danger me-3 fs-4"></i>
                                <span class="text-light opacity-75"><strong
                                        class="text-white d-block">Instagram</strong>@pinallesoutdoor</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
