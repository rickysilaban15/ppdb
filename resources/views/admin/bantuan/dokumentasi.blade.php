@extends('layouts.admin')

@section('title', 'Dokumentasi Sistem')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-book"></i>
            Dokumentasi Sistem PPDB
        </h1>
        <p class="page-subtitle">Panduan lengkap penggunaan sistem Penerimaan Peserta Didik Baru</p>
    </div>

    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Daftar Isi</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#pengenalan" class="list-group-item list-group-item-action">Pengenalan Sistem</a>
                        <a href="#dashboard" class="list-group-item list-group-item-action">Dashboard Admin</a>
                        <a href="#siswa" class="list-group-item list-group-item-action">Manajemen Siswa</a>
                        <a href="#jurusan" class="list-group-item list-group-item-action">Kelola Jurusan</a>
                        <a href="#seleksi" class="list-group-item list-group-item-action">Proses Seleksi</a>
                        <a href="#laporan" class="list-group-item list-group-item-action">Laporan & Export</a>
                        <a href="#pengaturan" class="list-group-item list-group-item-action">Pengaturan Sistem</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Pengenalan Sistem -->
            <div class="card mb-4" id="pengenalan">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Pengenalan Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Sistem PPDB SMK N 2 Siatas Barita</h6>
                    <p>Sistem ini dirancang untuk memudahkan proses Penerimaan Peserta Didik Baru dengan fitur-fitur lengkap:</p>
                    <ul>
                        <li><strong>Pendaftaran Online</strong> - Calon siswa dapat mendaftar secara online</li>
                        <li><strong>Manajemen Data</strong> - Kelola data siswa, jurusan, dan nilai</li>
                        <li><strong>Proses Seleksi</strong> - Sistem seleksi otomatis berdasarkan kriteria</li>
                        <li><strong>Laporan</strong> - Generate laporan dalam berbagai format</li>
                        <li><strong>Pengumuman</strong> - Publikasi hasil seleksi</li>
                    </ul>
                </div>
            </div>

            <!-- Dashboard Admin -->
            <div class="card mb-4" id="dashboard">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Fitur Dashboard</h6>
                    <p>Dashboard memberikan gambaran cepat tentang status sistem:</p>
                    <ul>
                        <li><strong>Statistik Pendaftaran</strong> - Lihat jumlah pendaftar, yang lulus, dan pending</li>
                        <li><strong>Quick Actions</strong> - Akses cepat ke fitur utama</li>
                        <li><strong>Grafik & Analytics</strong> - Visualisasi data pendaftaran</li>
                        <li><strong>Aktivitas Terbaru</strong> - Monitor aktivitas sistem terkini</li>
                    </ul>
                </div>
            </div>

            <!-- Manajemen Siswa -->
            <div class="card mb-4" id="siswa">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>Manajemen Data Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Fitur Manajemen Siswa</h6>
                    <ul>
                        <li><strong>Data Siswa</strong> - Lihat, tambah, edit, dan hapus data siswa</li>
                        <li><strong>Verifikasi Data</strong> - Verifikasi kelengkapan dokumen</li>
                        <li><strong>Update Status</strong> - Ubah status siswa (menunggu, lulus, tidak lulus)</li>
                        <li><strong>Export Data</strong> - Export data siswa ke Excel/PDF</li>
                        <li><strong>Bulk Actions</strong> - Aksi massal pada data siswa</li>
                    </ul>
                </div>
            </div>

            <!-- Kelola Jurusan -->
            <div class="card mb-4" id="jurusan">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>Kelola Jurusan
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Manajemen Program Studi</h6>
                    <ul>
                        <li><strong>Tambah Jurusan</strong> - Tambah program studi baru</li>
                        <li><strong>Edit Jurusan</strong> - Ubah informasi jurusan</li>
                        <li><strong>Kuota Penerimaan</strong> - Atur kuota per jurusan</li>
                        <li><strong>Monitoring Peminat</strong> - Lihat jumlah peminat per jurusan</li>
                    </ul>
                </div>
            </div>

            <!-- Proses Seleksi -->
            <div class="card mb-4" id="seleksi">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clipboard-check me-2"></i>Proses Seleksi
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Sistem Seleksi Otomatis</h6>
                    <ul>
                        <li><strong>Input Nilai</strong> - Masukkan nilai akademik siswa</li>
                        <li><strong>Prestasi</strong> - Tambah nilai prestasi</li>
                        <li><strong>Proses Seleksi</strong> - Jalankan sistem seleksi otomatis</li>
                        <li><strong>Ranking</strong> - Lihat peringkat siswa</li>
                        <li><strong>Penentuan Kelulusan</strong> - Tentukan siswa yang lulus</li>
                    </ul>
                </div>
            </div>

            <!-- Laporan & Export -->
            <div class="card mb-4" id="laporan">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Laporan & Export Data
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Fitur Laporan</h6>
                    <ul>
                        <li><strong>Laporan Statistik</strong> - Data statistik pendaftaran</li>
                        <li><strong>Export Excel</strong> - Export data ke format Excel</li>
                        <li><strong>Export PDF</strong> - Export data ke format PDF</li>
                        <li><strong>Custom Report</strong> - Buat laporan sesuai kebutuhan</li>
                    </ul>
                </div>
            </div>

            <!-- Pengaturan Sistem -->
            <div class="card mb-4" id="pengaturan">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Pengaturan Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Konfigurasi Sistem</h6>
                    <ul>
                        <li><strong>Pengaturan Umum</strong> - Nama sekolah, alamat, kontak</li>
                        <li><strong>Pengaturan PPDB</strong> - Periode pendaftaran, status</li>
                        <li><strong>Pengaturan Seleksi</strong> - Kriteria kelulusan</li>
                        <li><strong>Pengaturan Email</strong> - Konfigurasi SMTP</li>
                        <li><strong>Backup Data</strong> - Backup dan restore database</li>
                        <li><strong>Optimasi Sistem</strong> - Bersihkan cache dan optimasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.list-group-item {
    border: none;
    padding: 0.75rem 1rem;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}
</style>

<script>
// Smooth scroll for table of contents
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 20,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
@endsection