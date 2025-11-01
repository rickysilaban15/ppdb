@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Detail Jurusan</h4>

    <div class="card">
        <div class="card-body">
            <h5>{{ $jurusan->nama_lengkap }} ({{ $jurusan->kode_jurusan }})</h5>
            <p><strong>Bidang Keahlian:</strong> {{ $jurusan->bidang_keahlian }}</p>
            <p><strong>Kuota Reguler:</strong> {{ $jurusan->kuota_reguler }}</p>
            <p><strong>Kuota Unggulan:</strong> {{ $jurusan->kuota_unggulan }}</p>
            <p><strong>Peminat 1:</strong> {{ $jurusan->peminat_1 }}</p>
            <p><strong>Peminat 2:</strong> {{ $jurusan->peminat_2 }}</p>
            <p><strong>Diterima:</strong> {{ $jurusan->diterima }}</p>

            <hr>
            <p><strong>Deskripsi:</strong></p>
            <p>{{ $jurusan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
