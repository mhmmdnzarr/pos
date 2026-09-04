@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

    @include('layouts.navbar')

    <div class="container py-4">

        <!-- Header Page & Button Tambah -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Daftar Produk</h4>
                    <p class="text-muted small mb-0">Kelola inventaris, harga beli/jual, dan ketersediaan stok produk.</p>
                </div>
                <div>
                    @can('create', App\Models\Produk::class)
                        <a href="{{ route('produk.create') }}" class="btn btn-primary px-3 py-2 fw-medium shadow-sm">
                            Tambah Produk
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-3">
                <form action="{{ route('produk.index') }}" method="GET">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Cari berdasarkan nama produk...">
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button class="btn btn-primary w-100 fw-medium" type="submit">Cari</button>
                            @if (request('search'))
                                <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary"
                                    title="Reset Search">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Grid Card Produk -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">

                        <!-- Foto Produk -->
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            @if ($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}"
                                    class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <span class="text-muted small">Tidak ada foto</span>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">

                            <!-- Jenis -->
                            <span class="badge bg-light text-dark border fw-medium align-self-start mb-2">
                                {{ $product->jenis->nama_jenis ?? 'Tanpa Jenis' }}
                            </span>

                            <!-- Nama Produk -->
                            <h6 class="fw-semibold text-dark mb-1">{{ $product->nama }}</h6>

                            <!-- Harga -->
                            <div class="mb-2">
                                <span class="text-decoration-line-through text-muted small me-2">
                                    Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                </span>
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Stok -->
                            <div class="mb-3">
                                @if ($product->stok > 10)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Stok:
                                        {{ $product->stok }}</span>
                                @elseif($product->stok > 0)
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Stok:
                                        {{ $product->stok }}</span>
                                @else
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle">Habis</span>
                                @endif
                            </div>

                            <!-- Petugas -->
                            <p class="text-muted small mb-3">Ditambahkan oleh {{ $product->user->name ?? '-' }}</p>

                            <!-- Tombol Aksi -->
                            <div class="mt-auto d-flex gap-2">
                                @can('update', $product)
                                    <a href="{{ route('produk.edit', $product) }}"
                                        class="btn btn-sm btn-outline-primary flex-fill">
                                        Edit
                                    </a>
                                @endcan

                                @can('delete', $product)
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                            onclick="return confirm('Apakah Anda yakin menghapus produk ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body text-center py-5 text-muted">
                            <p class="mb-0 fs-6 fw-semibold text-dark">Data Produk Tidak Ditemukan</p>
                            <small class="text-muted">Belum ada produk yang ditambahkan atau tidak ada kata kunci yang
                                cocok.</small>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if (method_exists($products, 'hasPages') && $products->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @endif

    </div>

@endsection
