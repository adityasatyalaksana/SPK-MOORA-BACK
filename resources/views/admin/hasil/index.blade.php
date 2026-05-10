@extends('layouts.admin') {{-- Pastikan nama layout Anda sesuai --}}

@section('content')
<div class="container-fluid p-4">
    <h3 class="mb-4 fw-bold">Proses Perhitungan MOORA</h3>

    <!-- 1. Matriks Keputusan -->
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">1. Matriks Keputusan (Nilai Awal)</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="text-center bg-light">
                        <th>Jalur / Kriteria</th>
                        @foreach($kriterias as $k) <th>{{ $k->nama_kriteria }}</th> @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriks as $jalur => $kriteriaNilai)
                    <tr>
                        <td class="fw-bold">{{ $jalur }}</td>
                        @foreach($kriteriaNilai as $nilai) <td class="text-center">{{ $nilai }}</td> @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. Matriks Terbobot -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">2. Matriks Ternormalisasi Terbobot</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="text-center bg-light">
                        <th>Jalur / Kriteria</th>
                        @foreach($kriterias as $k) <th>{{ $k->nama_kriteria }}</th> @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($terbobot as $jalur => $kriteriaNilai)
                    <tr>
                        <td class="fw-bold">{{ $jalur }}</td>
                        @foreach($kriteriaNilai as $nilai) <td class="text-center">{{ number_format($nilai, 4) }}</td> @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Hasil Akhir -->
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">3. Hasil Akhir & Perangkingan</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover border">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Jalur</th>
                        <th>Nilai Max (Benefit)</th>
                        <th>Nilai Min (Cost)</th>
                        <th>Nilai Yi (Skor)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasil as $index => $data)
                    <tr class="text-center">
                        <td>
                            @if($index == 0)
                                <span class="badge bg-warning text-dark">🏆 Juara 1</span>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="text-start">{{ $data['jalur'] }}</td>
                        <td>{{ number_format($data['max'], 4) }}</td>
                        <td>{{ number_format($data['min'], 4) }}</td>
                        <td class="fw-bold">{{ number_format($data['skor'], 4) }}</td>
                        <td>
                            <span class="badge {{ $data['skor'] > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $data['skor'] > 0 ? 'Direkomendasikan' : 'Dipertimbangkan' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection