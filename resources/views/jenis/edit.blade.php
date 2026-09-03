@extends('layouts.app')

@section('title', 'Edit Jenis Produk')

@section('content')

    @include('layouts.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-sm rounded-3">

                    <!-- Card Header -->
                    <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">Edit Jenis Produk</h5>
                        <a href="{{ route('jenis.index') }}"
                            class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">

                        <!-- Alert Error Validation -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <strong>Terdapat kesalahan:</strong>
                                </div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Edit -->
                        <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="nama_jenis" class="form-label fw-semibold text-secondary">Nama Jenis</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <input type="text" name="nama_jenis" id="nama_jenis"
                                        value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                                        class="form-control @error('nama_jenis') is-invalid @enderror"
                                        placeholder="Masukkan nama jenis produk" required autofocus>
                                </div>
                                @error('nama_jenis')
                                    <div class="invalid-feedback d-block mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('jenis.index') }}" class="btn btn-light border px-3">Batal</a>
                                <button type="submit" class="btn btn-primary px-4 d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-save"></i>
                                    <span>Update</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
