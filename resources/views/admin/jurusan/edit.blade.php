@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Edit Jurusan</h4>
    <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
            <input type="text" name="kode_jurusan" id="kode_jurusan" class="form-control" value="{{ $jurusan->kode_jurusan }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control" value="{{ $jurusan->nama_jurusan }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap Jurusan</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="{{ $jurusan->nama_lengkap }}">
        </div>
        <div class="mb-3">
            <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
            <input type="text" name="bidang_keahlian" id="bidang_keahlian" class="form-control" value="{{ $jurusan->bidang_keahlian }}">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control">{{ $jurusan->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
