@extends('layouts.admin')

@section('title', 'Pengaturan Sekolah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar / Info Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h4>{{ $settings['nama_sekolah'] }}</h4>
                    <p class="text-muted">Tahun Ajaran: {{ $settings['tahun_ajaran'] }}</p>
                    <p class="text-muted">Email PPDB: {{ $settings['email_ppdb'] }}</p>
                    <p class="text-muted">Telp PPDB: {{ $settings['no_telp_ppdb'] }}</p>
                    <p class="text-muted">Alamat: {{ $settings['alamat_sekolah'] }}</p>
                </div>
            </div>
        </div>

        <!-- Form Pengaturan -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Pengaturan Sekolah</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')


                        <div class="mb-3">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ $settings['nama_sekolah'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ $settings['tahun_ajaran'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email_ppdb" class="form-label">Email PPDB</label>
                            <input type="email" class="form-control" id="email_ppdb" name="email_ppdb" value="{{ $settings['email_ppdb'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_telp_ppdb" class="form-label">No. Telepon PPDB</label>
                            <input type="text" class="form-control" id="no_telp_ppdb" name="no_telp_ppdb" value="{{ $settings['no_telp_ppdb'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                            <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="3" required>{{ $settings['alamat_sekolah'] }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Pengaturan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
