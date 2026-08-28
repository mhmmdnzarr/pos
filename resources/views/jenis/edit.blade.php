@extends('layouts.app')

@section('title', 'Edit Jenis Produk')

@section('content')

@include('layouts.navbar')

<div class="py-8 bg-gray-100 min-h-screen">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Jenis Produk</h1>
            <a href="{{ route('jenis.index') }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_jenis" class="block text-gray-700 font-medium mb-2">Nama Jenis</label>
                <input 
                    type="text" 
                    name="nama_jenis" 
                    id="nama_jenis" 
                    value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                >
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('jenis.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection