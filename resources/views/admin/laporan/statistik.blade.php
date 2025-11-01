    @extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📊 Statistik PPDB</h1>

    {{-- Statistik Jalur Pendaftaran --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Statistik Berdasarkan Jalur Pendaftaran</div>
        <div class="card-body">
            <canvas id="chartJalur"></canvas>
        </div>
    </div>

    {{-- Statistik Kelulusan --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Statistik Berdasarkan Status Kelulusan</div>
        <div class="card-body">
            <canvas id="chartKelulusan"></canvas>
        </div>
    </div>

    {{-- Statistik Jurusan --}}
    <div class="card">
        <div class="card-header fw-bold">Statistik Peminat per Jurusan</div>
        <div class="card-body">
            <canvas id="chartJurusan"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Statistik Jalur Pendaftaran
    const ctxJalur = document.getElementById('chartJalur');
    new Chart(ctxJalur, {
        type: 'pie',
        data: {
            labels: @json($statistikJalur['labels']),
            datasets: [{
                label: 'Jumlah Siswa',
                data: @json($statistikJalur['data']),
                borderWidth: 1
            }]
        },
    });

    // Statistik Kelulusan
    const ctxKelulusan = document.getElementById('chartKelulusan');
    new Chart(ctxKelulusan, {
        type: 'doughnut',
        data: {
            labels: @json($statistikKelulusan['labels']),
            datasets: [{
                label: 'Jumlah Siswa',
                data: @json($statistikKelulusan['data']),
                borderWidth: 1
            }]
        },
    });

    // Statistik Jurusan
    const ctxJurusan = document.getElementById('chartJurusan');
    new Chart(ctxJurusan, {
        type: 'bar',
        data: {
            labels: @json($statistikJurusan->pluck('nama_jurusan')),
            datasets: [{
                label: 'Peminat',
                data: @json($statistikJurusan->pluck('peminat')),
                borderWidth: 1
            }]
        },
    });
</script>
@endpush
