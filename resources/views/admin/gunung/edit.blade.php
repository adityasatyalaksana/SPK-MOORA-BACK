@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="mb-4">
        <h3 class="fw-bold text-dark">Edit Data Gunung: {{ $gunung->nama_gunung }}</h3>
        <p class="text-muted">Kelola informasi dan galeri foto gunung.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success border-0 mb-4">{{ session('success') }}</div>
            @endif

            <form action="{{ route('gunung.update', $gunung->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Nama Gunung</label>
                        <input type="text" name="nama_gunung" class="form-control" value="{{ old('nama_gunung', $gunung->nama_gunung) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $gunung->lokasi) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Ketinggian (MDPL)</label>
                        <input type="number" name="ketinggian" class="form-control" value="{{ old('ketinggian', $gunung->ketinggian) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Tambah Foto Baru</label>
                        <input type="file" name="gambar[]" class="form-control" accept="image/*" multiple>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $gunung->deskripsi) }}</textarea>
                </div>

                @if($gunung->gambar && count($gunung->gambar) > 0)
                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase text-danger">Galeri Saat Ini (Klik X untuk Hapus):</label>
                    <div class="row g-2 mt-1">
                        @foreach($gunung->gambar as $img)
                            <div class="col-md-2 position-relative">
                                <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded border shadow-sm" style="height: 100px; width: 100%; object-fit: cover;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle" 
                                        style="padding: 2px 6px;" 
                                        onclick="if(confirm('Hapus foto ini?')) { document.getElementById('delete-img-{{ md5($img) }}').submit(); }">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.gunung.index') }}" class="btn btn-light border">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
                </div>
            </form>

            @if($gunung->gambar)
                @foreach($gunung->gambar as $img)
                    <form id="delete-img-{{ md5($img) }}" action="{{ route('gunung.delete-image', $gunung->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="image_path" value="{{ $img }}">
                    </form>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection