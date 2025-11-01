@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">🏆 Hasil Ranking Siswa</h1>

    @if($top3->isEmpty())
        <div class="alert alert-warning">Belum ada siswa yang diterima untuk diranking.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Skor Akhir</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top3 as $siswa)
                    <tr>
                        <td><strong>{{ $siswa->ranking }}</strong></td>
                        <td>{{ $siswa->nama_lengkap }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ number_format($siswa->skor_akhir, 2) }}</td>
                        <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar Nilai</a>
</div>
@endsection
