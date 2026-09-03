@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')

@include('layouts.navbar')

<div class="container my-4">

    <!-- Notifikasi Error -->
    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Header Page & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Daftar Jenis</h1>
        </div>
        <div>
            @can('create', App\Models\Jenis::class)
            <a href="{{ route('jenis.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm px-3">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Jenis</span>
            </a>
            @endcan
        </div>
    </div>

    <!-- Filter & Form Pencarian -->
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-body p-3">
            <form action="{{ route('jenis.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           class="form-control border-end-0" 
                           placeholder="Cari berdasarkan nama jenis...">
                    <button class="btn btn-primary px-4" type="submit">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('jenis.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Jenis -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary">
                    <tr>
                        <th scope="col" class="ps-4" style="width: 10%;">No</th>
                        <th scope="col" style="width: 70%;">Nama Jenis</th>
                        <th scope="col" class="text-center pe-4" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenis as $item)
                    <tr>
                        <td class="ps-4 text-muted fw-medium">
                            {{ method_exists($jenis, 'firstItem') ? $jenis->firstItem() + $loop->index : $loop->iteration }}
                        </td>
                        <td class="fw-semibold text-dark">
                            {{ $item->nama_jenis }}
                        </td>
                        <td class="text-center pe-4">
                            <div class="d-inline-flex align-items-center gap-1">
                                @can('update', $item)
                                <a href="{{ route('jenis.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                @endcan

                                @can('delete', $item)
                                <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus jenis ini?')">
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <p class="mb-0 fs-5 fw-semibold text-secondary">Data jenis tidak tersedia.</p>
                            <small>Belum ada jenis produk yang ditambahkan atau tidak sesuai dengan pencarian.</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Render Link Pagination jika ada -->
        @if(method_exists($jenis, 'hasPages') && $jenis->hasPages())
        <div class="card-footer bg-white border-top py-3 px-4">
            {{ $jenis->links() }}
        </div>
        @endif
    </div>

</div>

@endsection