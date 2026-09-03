@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h3 fw-bold mb-1">Halaman Produk</h2>
        @can('create', App\Models\Produk::class)
            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                + Tambah Produk
            </a>
        @endcan
    </div>
    <hr style="color: white;">

    <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4 ms-auto">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama produk...">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">#</th>
                    <th style="width: 80px;">Foto</th>
                    <th>Nama Produk</th>
                    <th>Jenis</th>
                    <th>User</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>
                            @if($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <span class="text-muted small">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $product->nama }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $product->jenis->nama_jenis ?? 'Tanpa Jenis' }}
                            </span>
                        </td>
                        <td>{{ $product->user->name }}</td>
                        <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $product->stok }}</td>
                        <td class="text-center">
                            @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">Data produk tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $products->links() }}
    </div>
</div>
@endsection