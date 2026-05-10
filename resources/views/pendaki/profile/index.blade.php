@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Profil Gunung</h1>

    <div class="row">
        @forelse($gunung as $item)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
                    
                    {{-- Gambar Sampul --}}
                    <div style="height: 230px; overflow: hidden; background-color: #f8f9fa;">
                        @php
                            $fileUtama = is_array($item->gambar) && count($item->gambar) > 0 ? $item->gambar[0] : null;
                        @endphp
                        @if($fileUtama)
                            <img src="{{ asset('storage/' . $fileUtama) }}" class="card-img-top" style="object-fit: cover; height: 100%; width: 100%;" onerror="this.src='https://placehold.co/600x400?text=Gambar+Error';">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted"><i class="bi bi-image fs-1"></i></div>
                        @endif
                    </div>

                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold text-success mb-1">{{ $item->nama_gunung }}</h5>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-geo-alt-fill me-1 text-danger"></i> {{ $item->lokasi }} | {{ number_format($item->ketinggian) }} MDPL
                        </p>
                        
                        <div class="d-grid">
                            <button type="button" class="btn btn-success py-2" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}" style="border-radius: 10px; font-weight: 600;">
                                <i class="bi bi-info-circle me-1"></i> Detail Jalur
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL DETAIL --}}
            <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 pt-0">
                            {{-- CAROUSEL GAMBAR --}}
                            @if(is_array($item->gambar) && count($item->gambar) > 0)
                                <div id="carouselGunung{{ $item->id }}" class="carousel slide mb-4 rounded-4 overflow-hidden shadow-sm" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($item->gambar as $index => $img)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $img) }}" class="d-block w-100" style="height: 350px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(count($item->gambar) > 1)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGunung{{ $item->id }}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGunung{{ $item->id }}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                                    @endif
                                </div>
                            @endif

                            <h3 class="fw-bold text-success mb-1">{{ $item->nama_gunung }}</h3>
                            <p class="text-muted mb-4 small"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $item->lokasi }} | {{ number_format($item->ketinggian) }} MDPL</p>
                            
                            <h6 class="fw-bold text-dark mb-2">Deskripsi:</h6>
                            <div class="text-secondary mb-4 small" style="text-align: justify; line-height: 1.6;">
                                {!! nl2br(e($item->deskripsi)) !!}
                            </div>

                            <hr class="opacity-25">

                            {{-- TABEL JALUR SINKRON --}}
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-signpost-split-fill text-success me-2"></i>Jalur Pendakian & Estimasi:</h6>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3">Nama Jalur</th>
                                            <th>Kesulitan</th>
                                            <th class="text-end px-3">Estimasi Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($item->jalurs as $jalur)
                                            <tr>
                                                <td class="px-3 fw-bold text-success">{{ $jalur->nama_jalur }}</td>
                                                <td>
                                                    <span class="badge bg-info-subtle text-info border border-info-subtle">
                                                        {{ $jalur->tingkat_kesulitan ?? 'Sedang' }}
                                                    </span>
                                                </td>
                                                <td class="text-end px-3 fw-bold text-primary">
                                                    {{-- Asumsi kolom biaya bernama 'estimasi_biaya' di tabel jalurs --}}
                                                    Rp {{ number_format($jalur->biaya_simaksi ?? 0, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center text-muted small py-3">Data jalur belum tersedia.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 10px;">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5"><h5>Belum ada data gunung.</h5></div>
        @endforelse
    </div>
</div>

<style>
    .bg-success-subtle { background-color: #e8f5e9 !important; }
    .bg-info-subtle { background-color: #e3f2fd !important; }
    .card:hover { transform: translateY(-5px); transition: 0.3s ease-in-out; }
    .rounded-4 { border-radius: 1.5rem !important; }
</style>
@endsection