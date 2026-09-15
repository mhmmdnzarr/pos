<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Tentang')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<div class="container my-5">
    <!-- Hero / Header Section -->
    <div class="p-5 mb-4 rounded-3 text-center text-white shadow-lg" style="background-color: #2a364f; border: 1px solid rgba(255,255,255,0.08);">
        <h1 class="display-5 fw-bold text-warning">Pinalles Outdoor</h1>
        <p class="col-md-8 fs-5 mx-auto text-light">
            Solusi lengkap dan terpercaya untuk kebutuhan jual-beli serta penyewaan perlengkapan <i>camping</i> dan <i>trekking</i>.
        </p>
    </div>

    <!-- Card Informasi Perusahaan & Layanan -->
    <div class="row align-items-md-stretch g-4 mb-4">
        <div class="col-md-6">
            <div class="h-100 p-4 text-white rounded-3 shadow-sm" style="background-color: #2a364f; border: 1px solid rgba(255,255,255,0.08);">
                <h3 class="fw-bold mb-3 text-info">
                    <i class="bi bi-info-circle me-2"></i>Tentang Kami
                </h3>
                <p>
                    <strong>Pinalles Outdoor</strong> adalah penyedia perlengkapan luar ruangan (<i>outdoor</i>) yang berfokus pada kemudahan akses petualangan bagi para pendaki dan pecinta alam. Kami menyediakan layanan <strong>penjualan</strong> perlengkapan baru serta <strong>penyewaan</strong> alat-alat pendakian yang terawat, higienis, dan siap pakai.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="h-100 p-4 text-white rounded-3 shadow-sm" style="background-color: #2a364f; border: 1px solid rgba(255,255,255,0.08);">
                <h3 class="fw-bold mb-3 text-success">
                    <i class="bi bi-gear me-2"></i>Layanan Utama
                </h3>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Penyewaan Alat Outdoor:</strong> Tenda, <i>carrier</i>, <i>sleeping bag</i>, kompor portable, dan matras.
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Penjualan Peralatan:</strong> Menjual <i>gear</i> pendakian dan perlengkapan <i>camping</i> berkualitas.
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Kualitas & Kebersihan Terjamin:</strong> Semua alat yang disewakan melalui proses pembersihan dan pengecekan kelayakan.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Section Alamat & Kontak -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="h-100 p-4 text-white rounded-3 shadow-sm" style="background-color: #2a364f; border: 1px solid rgba(255,255,255,0.08);">
                <h3 class="fw-bold mb-3 text-warning">
                    <i class="bi bi-geo-alt me-2"></i>Lokasi Toko
                </h3>
                <p class="mb-2"><strong>Pinalles Outdoor Store</strong></p>
                <p class="text-light mb-0">
                    Jl. Raya Gunung No. 123, Kel. Sukamaju, Kec. Cilawu, Kota/Kabupaten, Jawa Barat 40123.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="h-100 p-4 text-white rounded-3 shadow-sm" style="background-color: #2a364f; border: 1px solid rgba(255,255,255,0.08);">
                <h3 class="fw-bold mb-3 text-danger">
                    <i class="bi bi-telephone me-2"></i>Hubungi Kami
                </h3>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-whatsapp text-success me-2"></i><strong>WhatsApp:</strong> +62 812-3456-7890
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope text-primary me-2"></i><strong>Email:</strong> info@pinallesoutdoor.com
                    </li>
                    <li>
                        <i class="bi bi-instagram text-danger me-2"></i><strong>Instagram:</strong> @pinallesoutdoor
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection