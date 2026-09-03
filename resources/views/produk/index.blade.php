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
                <a href="{{ route('produk.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 fw-medium shadow-sm">
                    <i class="bi bi-plus-lg fs-6"></i>
                    <span>Tambah Produk</span>
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
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Cari berdasarkan nama produk...">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-primary w-100 fw-medium" type="submit">Cari</button>
                        @if(request('search'))
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary" title="Reset Search">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-semibold">
                    <tr>
                        <th scope="col" class="ps-4 py-3" style="width: 60px;">No</th>
                        <th scope="col" class="py-3" style="width: 80px;">Foto</th>
                        <th scope="col" class="py-3">Nama Produk</th>
                        <th scope="col" class="py-3">Jenis</th>
                        <th scope="col" class="py-3">Petugas</th>
                        <th scope="col" class="py-3">Harga Beli</th>
                        <th scope="col" class="py-3">Harga Jual</th>
                        <th scope="col" class="text-center py-3">Stok</th>
                        <th scope="col" class="text-end pe-4 py-3" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($products as $product)
                    <tr>
                        <td class="ps-4 text-muted fw-medium">
                            {{ method_exists($products, 'firstItem') ? $products->firstItem() + $loop->index : $loop->iteration }}
                        </td>
                        <td>
                            @if($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="rounded shadow-sm border" style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted" style="width: 48px; height: 48px;">
                                    <i class="bi bi-image fs-5 opacity-50"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold text-dark">{{ $product->nama }}</td>
                        <td>
                            <span class="badge bg-light text-dark border fw-medium px-2 py-1">
                                <i class="bi bi-tag-fill text-primary me-1"></i>
                                {{ $product->jenis->nama_jenis ?? 'Tanpa Jenis' }}
                            </span>
                        </td>
                        <td class="text-muted small">
                            <i class="bi bi-person me-1"></i>{{ $product->user->name ?? '-' }}
                        </td>
                        <td class="text-secondary">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($product->stok > 10)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">{{ $product->stok }}</span>
                            @elseif($product->stok > 0)
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">{{ $product->stok }}</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">Habis</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex align-items-center gap-1">
                                @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-light border text-warning hover-shadow" title="Edit Data">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                @endcan

                                @can('delete', $product)
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger hover-shadow" onclick="return confirm('Apakah Anda yakin menghapus produk ini?')" title="Hapus Data">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 text-secondary opacity-50 d-block mb-2"></i>
                            <p class="mb-0 fs-6 fw-semibold text-dark">Data Produk Tidak Ditemukan</p>
                            <small class="text-muted">Belum ada produk yang ditambahkan atau tidak ada kata kunci yang cocok.</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($products, 'hasPages') && $products->hasPages())
        <div class="card-footer bg-white border-top py-3 px-4">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>

@endsection