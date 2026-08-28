@csrf

<div class="container my-5">
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center mb-1">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <strong class="fw-semibold">Terjadi kesalahan input:</strong>
        </div>
        <ul class="mb-0 ps-3 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">

        <!-- Nama Jenis -->
        <div class="mb-4">
            <label for="nama_jenis" class="form-label fw-semibold">Nama Jenis</label>
            <input type="text"
                   id="nama_jenis"
                   name="nama_jenis"
                   placeholder="Masukkan nama jenis (misal: Minuman)"
                   class="form-control @error('nama_jenis') is-invalid @enderror"
                   value="{{ old('nama_jenis', $jenis->nama_jenis ?? '') }}">
            @error('nama_jenis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <hr class="text-muted opacity-25 my-4">

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('jenis.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            <button type="submit" class="btn btn-primary px-4 fw-semibold">Simpan Jenis</button>
        </div>

    </div>
</div>
</div>