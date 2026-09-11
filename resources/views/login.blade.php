@extends('layouts.app')

@section('title', 'Login - Pinalles Outdoor')

@section('content')

<div class="d-flex align-items-center justify-content-center vh-100">

    <div class="card border-0 shadow-lg rounded-4" style="width: 23rem; background-color: #ffffff;">

        <div class="card-body p-4 text-center">

            {{-- Branding Header --}}
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle mb-2" style="width: 48px; height: 48px;">
                    <i class="bi bi-compass fs-4"></i>
                </div>
                <h4 class="fw-bold text-dark mb-0">PINALLES OUTDOOR</h4>
                <p class="text-muted small">Basecamp POS System</p>
            </div>

            {{-- Alert Status --}}
            @if (session('status'))
                <div class="alert alert-success py-2 small text-start mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('auth') }}" method="POST" class="text-start">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="form-control form-control-lg fs-6 @error('email') is-invalid @enderror"
                        placeholder="nama@email.com"
                        autofocus
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary btn-lg fs-6 fw-semibold rounded-3">
                        Masuk Sistem
                    </button>
                </div>
            </form>

        </div>

    </div>

</div>

@endsection