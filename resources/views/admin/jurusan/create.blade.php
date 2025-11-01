@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Tambah Jurusan Baru</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.jurusan.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kode_jurusan" class="form-label fw-bold">Kode Jurusan</label>
                        <input type="text" name="kode_jurusan" id="kode_jurusan" 
                               class="form-control" value="{{ old('kode_jurusan') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_jurusan" class="form-label fw-bold">Nama Jurusan (Singkat)</label>
                        <input type="text" name="nama_jurusan" id="nama_jurusan" 
                               class="form-control" value="{{ old('nama_jurusan') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap Jurusan</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" 
                           class="form-control" value="{{ old('nama_lengkap') }}" required>
                </div>

                <div class="mb-3">
                    <label for="bidang_keahlian" class="form-label fw-bold">Bidang Keahlian</label>
                    <input type="text" name="bidang_keahlian" id="bidang_keahlian" 
                           class="form-control" value="{{ old('bidang_keahlian') }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kuota_reguler" class="form-label fw-bold">Kuota Reguler</label>
                        <input type="number" name="kuota_reguler" id="kuota_reguler" 
                               class="form-control" value="{{ old('kuota_reguler', 0) }}" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kuota_unggulan" class="form-label fw-bold">Kuota Unggulan</label>
                        <input type="number" name="kuota_unggulan" id="kuota_unggulan" 
                               class="form-control" value="{{ old('kuota_unggulan', 0) }}" min="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi Jurusan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
