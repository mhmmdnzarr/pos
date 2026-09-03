@section('title', 'Users')

@section('content')

@include('layouts.navbar')
@csrf

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4 text-dark">

        <!-- Nama -->
        <div class="mb-3">
            <label class="form-label fw-semibold">
                <i class="bi bi-person me-1 text-primary"></i>Nama Lengkap
            </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name ?? '') }}" autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label fw-semibold">
                <i class="bi bi-envelope me-1 text-primary"></i>Alamat Email
            </label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="nama@email.com" value="{{ old('email', $user->email ?? '') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label fw-semibold">
                <i class="bi bi-lock me-1 text-primary"></i>Password
            </label>
            <div class="input-group">
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password' }}">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if (isset($user))
                <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
            @endif
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label class="form-label fw-semibold">
                <i class="bi bi-shield-lock me-1 text-primary"></i>Role / Akses
            </label>
            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <a href="{{ route('admin.users') }}" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-check-circle me-1"></i> Simpan
            </button>
        </div>

    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>
@endpush
@endsection