@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content') 

@include('layouts.navbar') 

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Jenis Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenis.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_jenis" class="form-label">Nama Jenis</label>
                            <input type="text" name="nama_jenis" id="nama_jenis" class="form-control @error('nama_jenis') is-invalid @enderror" value="{{ old('nama_jenis') }}" placeholder="Masukkan nama jenis (misal: Minuman)" required>
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection