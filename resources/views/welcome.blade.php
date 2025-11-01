@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary: #800000;      /* Merah Maroon */
        --primary-dark: #5C0000; /* Merah Maroon lebih gelap */
        --primary-light: #A52A2A; /* Merah Maroon lebih terang */
        --secondary: #333333;    /* Abu-abu gelap mendekati hitam */
        --gold: #D4AF37;         /* Emas */
        --gold-light: #E6C35C;   /* Emas lebih terang */
        --light: #f8f8f8;        /* Putih sangat terang */
        --dark: #1a1a1a;         /* Hitam pekat */
        --white: #ffffff;        /* Putih bersih */
        --gray-light: #f5f5f5;   /* Abu-abu sangat terang */
        --gradient: linear-gradient(135deg, #800000 0%, #1a1a1a 100%); /* Maroon ke Hitam */
        --gradient-gold: linear-gradient(135deg, #D4AF37 0%, #800000 100%); /* Emas ke Maroon */
        --gradient-light: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(245,245,245,0.9) 100%); /* Putih transparan */
    }

    /* Global Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--dark);
        background-color: var(--white);
    }

    /* Hero Section */
    .hero-section {
        background: var(--gradient);
        color: var(--white);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
        min-height: 90vh;
        display: flex;
        align-items: center;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0icmdiYSgyMTIsIDE3NSwgNTUsIDAuMSkiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjcGF0dGVybikiLz48L3N2Zz4=');
        opacity: 0.2;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        color: var(--white);
    }

    .hero-subtitle {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--gold);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }

    /* Section Styling */
    .section {
        padding: 4rem 0;
        position: relative;
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--primary);
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--gold);
        border-radius: 2px;
    }

    /* Cards */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background-color: var(--white);
        height: 100%;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .card-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .card-header {
        border: none;
        padding: 1.25rem;
        background-color: var(--primary);
        color: var(--white);
    }

    .card-header.bg-primary {
        background-color: var(--primary) !important;
    }

    .card-header.bg-success {
        background-color: var(--primary) !important;
    }

    .card-header.bg-warning {
        background-color: var(--gold) !important;
        color: var(--dark) !important;
    }

    .card-header.bg-info {
        background-color: var(--secondary) !important;
    }

    /* Jurusan Cards */
    .jurusan-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background-color: var(--white);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .jurusan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .jurusan-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: var(--primary-light);
        color: var(--white);
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .jurusan-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .jurusan-subtitle {
        font-size: 0.9rem;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .jurusan-description {
        font-size: 0.9rem;
        color: var(--secondary);
        flex-grow: 1;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background: var(--secondary);
        border-radius: 3px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 2rem;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item::before {
        content: "";
        position: absolute;
        left: -2.3rem;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: var(--white);
        border: 3px solid var(--primary);
    }

    .timeline-date {
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 30px;
        display: inline-block;
        margin-bottom: 0.75rem;
        background-color: var(--primary);
        color: var(--white);
    }

    .timeline-date.bg-primary {
        background-color: var(--primary) !important;
    }

    .timeline-date.bg-success {
        background-color: var(--primary) !important;
    }

    .timeline-date.bg-warning {
        background-color: var(--gold) !important;
        color: var(--dark) !important;
    }

    .timeline-date.bg-info {
        background-color: var(--secondary) !important;
    }

    /* Buttons */
    .btn {
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        color: var(--white);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(128, 0, 0, 0.3);
    }

    .btn-outline-light:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-3px);
    }

    .btn-light {
        background: var(--white);
        color: var(--primary);
        border: none;
    }

    .btn-light:hover {
        background: var(--gold);
        color: var(--dark);
    }

    .btn-outline-light {
        color: var(--white);
        border: 2px solid var(--white);
    }

    /* Animations */
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in-up.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Text Colors */
    .text-primary {
        color: var(--primary) !important;
    }

    .text-muted {
        color: var(--secondary) !important;
    }

    .text-success {
        color: var(--primary) !important;
    }

    .text-warning {
        color: var(--gold) !important;
    }

    /* Background Colors */
    .bg-light {
        background-color: var(--gray-light) !important;
    }

    .bg-primary {
        background-color: var(--primary) !important;
    }

    .bg-success {
        background-color: var(--primary) !important;
    }

    .bg-warning {
        background-color: var(--gold) !important;
    }

    .bg-info {
        background-color: var(--secondary) !important;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-section {
            padding: 4rem 0;
            min-height: 80vh;
        }
        
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 3rem 0;
            min-height: 70vh;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .btn {
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            padding: 2rem 0;
            min-height: 60vh;
        }
        
        .hero-title {
            font-size: 1.8rem;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
        }
        
        .section-title {
            font-size: 1.6rem;
        }
        
        .btn {
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
        }
    }
</style>
@endsection

@section('title', 'PPDB SMK N 2 Siatas Barita - Tahun Ajaran 2026/2027')



@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content fade-in-up">
                    <h1 class="hero-title">Penerimaan Peserta Didik Baru</h1>
                    <h2 class="hero-subtitle">SMK N 2 Siatas Barita</h2>
                    <p class="lead mb-4">Tahun Ajaran 2026/2027<br>Membangun Generasi Unggul, Siap Kerja, dan Berkarakter</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('pendaftaran.form') }}" class="btn btn-light">
                            <i class="fas fa-edit me-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{ route('pengumuman.public') }}" class="btn btn-outline-light">
                            <i class="fas fa-bullhorn me-2"></i>Lihat Pengumuman
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 fade-in-up">
                    <div class="hero-image">
                        <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                            alt="SMK N 2 Siatas Barita" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="min-h-screen bg-gradient-to-br from-purple-600 to-pink-500 text-white flex items-center justify-center">
  <h1 class="text-4xl font-bold">Tailwind Sudah Aktif ✅</h1>
</div>

    <!-- Info Section -->
    <section class="section bg-light" id="info">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 fade-in-up">
                    <div class="card h-100 text-center border-0">
                        <div class="card-body p-4">
                            <i class="fas fa-calendar-alt card-icon"></i>
                            <h5 class="card-title">Jadwal Pendaftaran</h5>
                            <p class="card-text">1 Januari - 31 Maret 2026</p>
                            <small class="text-muted">Jangan sampai terlewat!</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up">
                    <div class="card h-100 text-center border-0">
                        <div class="card-body p-4">
                            <i class="fas fa-graduation-cap card-icon"></i>
                            <h5 class="card-title">18 Jurusan</h5>
                            <p class="card-text">Berbagai bidang keahlian tersedia</p>
                            <small class="text-muted">Pilihan lengkap untuk masa depan</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up">
                    <div class="card h-100 text-center border-0">
                        <div class="card-body p-4">
                            <i class="fas fa-users card-icon"></i>
                            <h5 class="card-title">Kuota Terbatas</h5>
                            <p class="card-text">36 siswa reguler & 12 siswa unggulan per jurusan</p>
                            <small class="text-muted">Segera daftar!</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Sekolah -->
    <section class="section" id="tentang">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Tentang SMK N 2 Siatas Barita</h2>
                <p class="lead text-muted">Mengenal lebih dekat sekolah kami</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in-up mb-4 mb-lg-0">
                    <div class="img-container rounded-3 overflow-hidden shadow">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                             alt="Tentang Sekolah" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-lg-6 fade-in-up">
                    <h3 class="mb-4">Visi dan Misi Sekolah</h3>
                    <div class="mb-4">
                        <h5 class="text-primary">Visi</h5>
                        <p>Menjadi SMK unggulan yang menghasilkan lulusan kompeten, berkarakter, dan siap bersaing di pasar global.</p>
                    </div>
                    <div>
                        <h5 class="text-primary">Misi</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Menyelenggarakan pendidikan kejuruan yang berkualitas</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Membangun karakter siswa yang berintegritas</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Menjalin kerjasama dengan industri</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Mengembangkan potensi siswa secara optimal</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section class="section bg-light" id="jurusan">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Program Jurusan</h2>
                <p class="lead text-muted">Pilih dari 18 jurusan unggulan dengan berbagai bidang keahlian</p>
            </div>
            
            <div class="row g-4">
                @php
                    $jurusans = [
                        [
                            'kode' => 'TKRO',
                            'nama' => 'Teknik Kendaraan Ringan Otomotif',
                            'deskripsi' => 'Mempelajari perawatan dan perbaikan kendaraan bermotor roda empat.',
                            'icon' => 'fas fa-car'
                        ],
                        [
                            'kode' => 'TBSM',
                            'nama' => 'Teknik Sepeda Motor',
                            'deskripsi' => 'Mempelajari perawatan dan perbaikan sepeda motor.',
                            'icon' => 'fas fa-motorcycle'
                        ],
                        [
                            'kode' => 'TSM',
                            'nama' => 'Teknik Mekanik Otomotif',
                            'deskripsi' => 'Mempelajari mesin dan sistem mekanik pada kendaraan.',
                            'icon' => 'fas fa-cogs'
                        ],
                        [
                            'kode' => 'TKJ',
                            'nama' => 'Teknik Komputer dan Jaringan',
                            'deskripsi' => 'Mempelajari perakitan komputer dan jaringan komputer.',
                            'icon' => 'fas fa-network-wired'
                        ],
                        [
                            'kode' => 'RPL',
                            'nama' => 'Rekayasa Perangkat Lunak',
                            'deskripsi' => 'Mempelajari pengembangan aplikasi dan software.',
                            'icon' => 'fas fa-code'
                        ],
                        [
                            'kode' => 'TITL',
                            'nama' => 'Teknik Instalasi Tenaga Listrik',
                            'deskripsi' => 'Mempelajari pemasangan dan perawatan instalasi listrik.',
                            'icon' => 'fas fa-bolt'
                        ],
                        [
                            'kode' => 'AKL',
                            'nama' => 'Akuntansi dan Keuangan Lembaga',
                            'deskripsi' => 'Mempelajari akuntansi dan manajemen keuangan.',
                            'icon' => 'fas fa-calculator'
                        ],
                        [
                            'kode' => 'OTKP',
                            'nama' => 'Otomatisasi dan Tata Kelola Perkantoran',
                            'deskripsi' => 'Mempelajari administrasi perkantoran modern.',
                            'icon' => 'fas fa-briefcase'
                        ],
                        [
                            'kode' => 'PEMASARAN',
                            'nama' => 'Pemasaran',
                            'deskripsi' => 'Mempelajari strategi pemasaran produk dan jasa.',
                            'icon' => 'fas fa-chart-line'
                        ],
                        [
                            'kode' => 'ATPH',
                            'nama' => 'Agribisnis Tanaman Pangan dan Hortikultura',
                            'deskripsi' => 'Mempelajari budidaya tanaman pangan dan hortikultura.',
                            'icon' => 'fas fa-seedling'
                        ],
                        [
                            'kode' => 'DKV',
                            'nama' => 'Desain Komunikasi Visual',
                            'deskripsi' => 'Mempelajari desain grafis dan komunikasi visual.',
                            'icon' => 'fas fa-paint-brush'
                        ],
                        [
                            'kode' => 'DPIB',
                            'nama' => 'Desain Pemodelan dan Informasi Bangunan',
                            'deskripsi' => 'Mempelajari desain bangunan dan pemodelan 3D.',
                            'icon' => 'fas fa-building'
                        ],
                        [
                            'kode' => 'TM',
                            'nama' => 'Teknik Mesin',
                            'deskripsi' => 'Mempelajari permesinan dan produksi.',
                            'icon' => 'fas fa-industry'
                        ],
                        [
                            'kode' => 'TP',
                            'nama' => 'Teknik Pengelasan',
                            'deskripsi' => 'Mempelajari teknik pengelasan dan fabrikasi logam.',
                            'icon' => 'fas fa-fire'
                        ],
                        [
                            'kode' => 'MM',
                            'nama' => 'Multimedia',
                            'deskripsi' => 'Mempelajari pembuatan konten multimedia.',
                            'icon' => 'fas fa-photo-video'
                        ],
                        [
                            'kode' => 'FARMASI',
                            'nama' => 'Farmasi',
                            'deskripsi' => 'Mempelajari obat-obatan dan layanan farmasi.',
                            'icon' => 'fas fa-pills'
                        ],
                        [
                            'kode' => 'TATA_BOGA',
                            'nama' => 'Tata Boga',
                            'deskripsi' => 'Mempelajari seni memasak dan pengelolaan kuliner.',
                            'icon' => 'fas fa-utensils'
                        ],
                        [
                            'kode' => 'TATA_BUSANA',
                            'nama' => 'Tata Busana',
                            'deskripsi' => 'Mempelajari desain dan pembuatan pakaian.',
                            'icon' => 'fas fa-tshirt'
                        ]
                    ];
                @endphp
                
                @foreach($jurusans as $jurusan)
                <div class="col-lg-4 col-md-6 fade-in-up">
                    <div class="jurusan-card">
                        <div class="card-body p-4">
                            <div class="jurusan-icon">
                                <i class="{{ $jurusan['icon'] }}"></i>
                            </div>
                            <h5 class="jurusan-title">{{ $jurusan['nama'] }}</h5>
                            <p class="jurusan-subtitle">{{ $jurusan['kode'] }}</p>
                            <p class="jurusan-description">{{ $jurusan['deskripsi'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Persyaratan Section -->
    <section class="section" id="persyaratan">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Persyaratan Pendaftaran</h2>
                <p class="lead text-muted">Persiapkan dokumen-dokumen berikut untuk mendaftar</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 fade-in-up">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Dokumen Wajib</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-0">Kartu Keluarga (KK)</h6>
                                        <small class="text-muted">Fotokopi dilegalisir</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-0">Akta Kelahiran</h6>
                                        <small class="text-muted">Fotokopi dilegalisir</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-0">Ijazah/Surat Keterangan Lulus</h6>
                                        <small class="text-muted">Bagi yang sudah lulus SMP</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-0">Pas Foto 3x4</h6>
                                        <small class="text-muted">4 lembar, berwarna</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-0">Transkrip Nilai Rapor</h6>
                                        <small class="text-muted">Semester 1-5 SMP</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 fade-in-up">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Jalur Pendaftaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-map-marker-alt text-primary mb-2" style="font-size: 1.5rem;"></i>
                                            <h6>Zonasi</h6>
                                            <small class="text-muted">KK & Bukti Domisili</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-trophy text-warning mb-2" style="font-size: 1.5rem;"></i>
                                            <h6>Prestasi</h6>
                                            <small class="text-muted">Piagam/Sertifikat</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-hand-holding-heart text-danger mb-2" style="font-size: 1.5rem;"></i>
                                            <h6>Afirmasi</h6>
                                            <small class="text-muted">SKTM/KIP</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-exchange-alt text-info mb-2" style="font-size: 1.5rem;"></i>
                                            <h6>Mutasi</h6>
                                            <small class="text-muted">Surat Tugas Orang Tua</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Section -->
    <section class="section bg-light" id="jadwal">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Jadwal PPDB 2026</h2>
                <p class="lead text-muted">Catat tanggal-tanggal penting berikut</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm fade-in-up">
                        <div class="card-body p-4">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-date bg-primary text-white">1 Jan - 31 Mar 2026</div>
                                    <div class="timeline-content">
                                        <h5>Pendaftaran Online</h5>
                                        <p>Melalui website PPDB SMK N 2 Siatas Barita</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-date bg-success text-white">1 - 15 Apr 2026</div>
                                    <div class="timeline-content">
                                        <h5>Verifikasi Berkas</h5>
                                        <p>Proses verifikasi dokumen oleh panitia</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-date bg-warning text-dark">20 Apr 2026</div>
                                    <div class="timeline-content">
                                        <h5>Pengumuman Hasil</h5>
                                        <p>Pengumuman kelulusan melalui website</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-date bg-info text-white">25 - 30 Apr 2026</div>
                                    <div class="timeline-content">
                                        <h5>Daftar Ulang</h5>
                                        <p>Registrasi ulang bagi yang diterima</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: var(--gradient-gold); color: var(--white);">
        <div class="container text-center">
            <h2 class="mb-4">Siap Bergabung Dengan Kami?</h2>
            <p class="lead mb-4">Jangan lewatkan kesempatan untuk menjadi bagian dari SMK N 2 Siatas Barita</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('pendaftaran.form') }}" class="btn btn-light px-4">
                    <i class="fas fa-edit me-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('pengumuman.public') }}" class="btn btn-outline-light px-4">
                    <i class="fas fa-info-circle me-2"></i>Informasi Lebih Lanjut
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in animation on scroll
        const fadeElements = document.querySelectorAll('.fade-in-up');
        
        const fadeInOnScroll = () => {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        };
        
        // Initial check
        fadeInOnScroll();
        
        // Check on scroll
        window.addEventListener('scroll', fadeInOnScroll);
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endsection