@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 80px);">
    <div class="card border-0 shadow-sm" style="width: 100%; max-width: 900px;">
        <div class="card-header bg-primary text-white d-flex align-items-center gap-2">
            <i class="bi bi-box-seam fs-5"></i>
            <h5 class="mb-0">Tambah Produk</h5>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @include('produk._form')
        </form>
    </div>
</div>
@endsection