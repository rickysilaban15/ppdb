@extends('layouts.admin')

@section('title', 'Bantuan & Support')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-question-circle"></i>
            Bantuan & Support
        </h1>
        <p class="page-subtitle">Pusat bantuan dan panduan penggunaan sistem</p>
    </div>

    <!-- Help Cards -->
    <div class="row">
        <!-- Dokumentasi -->
        <div class="col-md-4 mb-4">
            <div class="card help-card">
                <div class="card-body text-center">
                    <div class="help-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5 class="card-title">Dokumentasi</h5>
                    <p class="card-text">Panduan lengkap penggunaan sistem PPDB</p>
                    <a href="{{ route('admin.bantuan.dokumentasi') }}" class="btn btn-primary">
                        Buka Dokumentasi
                    </a>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="col-md-4 mb-4">
            <div class="card help-card">
                <div class="card-body text-center">
                    <div class="help-icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <h5 class="card-title">FAQ</h5>
                    <p class="card-text">Pertanyaan yang sering diajukan</p>
                    <a href="{{ route('admin.bantuan.faq') }}" class="btn btn-success">
                        Lihat FAQ
                    </a>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="col-md-4 mb-4">
            <div class="card help-card">
                <div class="card-body text-center">
                    <div class="help-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="card-title">Kontak Support</h5>
                    <p class="card-text">Hubungi tim support untuk bantuan lebih lanjut</p>
                    <a href="{{ route('admin.bantuan.kontak') }}" class="btn btn-info">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Help -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-bolt"></i>
                        Bantuan Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Masalah Umum:</h6>
                            <ul class="list-unstyled">
                                <li>• <a href="#" class="text-decoration-none">Cara reset password admin</a></li>
                                <li>• <a href="#" class="text-decoration-none">Troubleshoot laporan</a></li>
                                <li>• <a href="#" class="text-decoration-none">Import data siswa</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Video Tutorial:</h6>
                            <ul class="list-unstyled">
                                <li>• <a href="#" class="text-decoration-none">Pengelolaan data siswa</a></li>
                                <li>• <a href="#" class="text-decoration-none">Proses seleksi</a></li>
                                <li>• <a href="#" class="text-decoration-none">Generate laporan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.help-card {
    transition: transform 0.3s ease;
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.help-card:hover {
    transform: translateY(-5px);
}

.help-icon {
    font-size: 3rem;
    color: var(--gold);
    margin-bottom: 1rem;
}

.card-title {
    font-weight: 600;
    margin-bottom: 1rem;
}
</style>
@endsection