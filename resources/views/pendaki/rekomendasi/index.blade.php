@extends('layouts.admin') {{-- Pastikan nama layout sesuai dengan yang Anda gunakan --}}

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4">
                    <h3 class="fw-bold text-success">Cari Rekomendasi Gunung</h3>
                    <p class="text-muted">Masukkan budget dan titik keberangkatan Anda untuk melihat estimasi biaya pendakian.</p>
                </div>
                <div class="card-body p-4">
                    {{-- Form ini akan mengirim data ke fungsi 'proses' di RekomendasiController --}}
                    <form action="{{ route('rekomendasi.proses') }}" method="GET">
                        <div class="row">
                            <!-- Input Budget -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Budget Maksimal (Rp)</label>
                                <input type="number" name="budget" class="form-control" placeholder="Contoh: 500000" required>
                                <small class="text-muted">Total budget untuk seluruh anggota kelompok.</small>
                            </div>

                            <!-- Input Jumlah Anggota -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Jumlah Anggota (Orang)</label>
                                <input type="number" name="jumlah_anggota" class="form-control" placeholder="Contoh: 4" min="1" required>
                                <small class="text-muted">Termasuk Anda sendiri.</small>
                            </div>

                            <!-- Pilih Terminal -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Terminal Keberangkatan</label>
                                <select name="terminal_id" class="form-control" required>
                                    <option value="">-- Pilih Terminal --</option>
                                    @foreach($terminals as $t)
                                        <option value="{{ $t->id }}">{{ $t->nama_terminal }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Lokasi asal keberangkatan bus.</small>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5 fw-bold" style="border-radius: 10px;">
                                <i class="fas fa-search me-2"></i> Cari Rekomendasi
                            </button>
                            <a href="{{ route('beranda.index') }}" class="btn btn-light px-4 ms-2" style="border-radius: 10px;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection