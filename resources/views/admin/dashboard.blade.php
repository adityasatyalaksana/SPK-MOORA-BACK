@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h2 class="fw-bold">Selamat Datang, Admin!</h2>
                    <p class="text-muted">Ini adalah halaman utama panel kendali Sistem Penunjang Keputusan Rekomendasi Gunung dengan Metode MOORA.</p>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded border-start border-success border-4">
                                <h6 class="text-muted">Status Sistem</h6>
                                <p class="fw-bold mb-0 text-success">Aktif / Online</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection