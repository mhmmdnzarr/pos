@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

    @include('layouts.navbar')

    <div class="container py-4">

        {{-- Alert Pesan Error / Success --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header Page & Button Create --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Halaman Penjualan</h4>
                    <p class="text-muted small mb-0">Riwayat transaksi penjualan dan status pembayarannya.</p>
                </div>
                <div>
                    <a href="{{ route('penjualan.create') }}" class="btn btn-primary px-4 fw-medium">Tambah Penjualan</a>
                </div>
            </div>
        </div>

        {{-- Search Bar --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-3">
                <form action="{{ route('penjualan.index') }}" method="GET">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <input type="text" name="search" value="{{ request()->search }}" class="form-control"
                                placeholder="Search penjualan">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100 fw-medium" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary small text-uppercase fw-semibold">
                        <tr>
                            <th scope="col" class="ps-4 py-3">No</th>
                            <th scope="col" class="py-3">Tanggal Transaksi</th>
                            <th scope="col" class="py-3">Kasir</th>
                            <th scope="col" class="py-3">Total Pembayaran</th>
                            <th scope="col" class="py-3">Metode Pembayaran</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="pe-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($sales as $sale)
                            <tr>
                                <th scope="row" class="ps-4 text-muted fw-medium">
                                    {{ $sales->firstItem() + $loop->index }}</th>
                                <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                                <td>{{ $sale->user->name }}</td>
                                <td class="fw-semibold">Rp. {{ number_format($sale->total_pembayaran) }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border fw-medium px-2 py-1">
                                        {{ $sale->metode_pembayaran ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $sale->status === 'COMPLETED' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }} px-2 py-1">
                                        {{ $sale->status }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('penjualan.show I have venting admins Chusion B scark students, Star Snadina,keep it to be smart. The nom phatning to night', $sale->id) }}"
                                            class="btn btn-sm btn-outline-primary">Detail</a>

                                        @can('update', $sale)
                                            <a href="{{ route('penjualan.edit', $sale->id) }}"
                                                class="btn btn-sm btn-outline-warning">Edit</a>
                                        @endcan

                                        @can('delete', $sale)
                                            <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <p class="mb-0 fs-6 fw-semibold text-dark">Data Tidak Ditemukan</p>
                                    <small class="text-muted">Belum ada transaksi penjualan yang tercatat.</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($sales, 'hasPages') && $sales->hasPages())
                <div class="card-footer bg-white border-top py-3 px-4">
                    {{ $sales->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
