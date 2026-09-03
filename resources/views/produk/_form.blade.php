@csrf

<style>
    .foto-preview-box {
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .foto-preview-box img {
        max-height: 150px;
        display: none;
    }
</style>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4 text-dark">
        <div class="row g-4">

            <!-- Kolom Kiri: Input Data Utama -->
            <div class="col-md-7">

                {{-- Nama Produk --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Masukkan nama produk"
                           value="{{ old('name', $produk->nama ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Produk --}}
                <div class="mb-3">
                    <label for="jenis_id" class="form-label fw-semibold">Jenis Produk</label>
                    <select name="jenis_id" id="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Produk --</option>
                        @foreach($jenis as $item)
                            <option value="{{ $item->id }}" {{ old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Group Harga -->
                <div class="row">
                    {{-- Harga Beli --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga Beli</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="purchase_price"
                                   class="form-control @error('purchase_price') is-invalid @enderror"
                                   placeholder="0"
                                   value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
                        </div>
                        @error('purchase_price')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga Jual --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga Jual</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="selling_price"
                                   class="form-control @error('selling_price') is-invalid @enderror"
                                   placeholder="0"
                                   value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
                        </div>
                        @error('selling_price')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stock"
                           class="form-control @error('stock') is-invalid @enderror"
                           placeholder="0"
                           value="{{ old('stock', $produk->stok ?? '') }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Kolom Kanan: Upload Foto & Preview -->
            <div class="col-md-5">

                {{-- Foto Saat Ini (Mode Edit) --}}
                @if (!empty($produk->foto))
                    <div class="mb-3 p-3 bg-light rounded border text-center">
                        <label class="form-label fw-semibold d-block text-muted small">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                             class="img-thumbnail rounded" style="max-height: 150px;">
                    </div>
                @endif

                {{-- Upload Gambar Baru --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Baru</label>
                    <input type="file" name="foto" id="fotoInput" accept="image/*"
                           class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Preview Foto Baru --}}
                <div class="p-3 bg-light rounded border text-center">
                    <label class="form-label fw-semibold d-block text-muted small mb-2">Preview Foto Baru</label>
                    <div class="foto-preview-box bg-white rounded border">
                        <img id="preview">
                        <span id="no-preview-text" class="text-muted small">Belum ada foto dipilih</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary px-4">Kembali</a>
            <button class="btn btn-success px-4" type="submit">Simpan</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('fotoInput').addEventListener('change', function () {
        var file = this.files[0];
        var img = document.getElementById('preview');
        var txt = document.getElementById('no-preview-text');

        if (file) {
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
            txt.style.display = 'none';
        } else {
            img.style.display = 'none';
            txt.style.display = 'block';
        }
    });
</script>