@extends('layouts.app-tailwind')
@section('title', 'Beranda - PPDB SMK N 2 Siatas Barita')

@section('content')
<!-- Hero Section dengan Video Background -->
<section class="hero-section text-white py-20 relative overflow-hidden min-h-screen flex items-center" id="beranda">
    
    <!-- Video Background -->
    <video class="absolute inset-0 w-full h-full object-cover z-0" autoplay loop muted playsinline>
        <source src="/videos/bg_hs.mp4" type="video/mp4">
        
        Browser Anda tidak mendukung video background.
    </video>
    
    <!-- Overlay Gelap untuk Meningkatkan Keterbacaan Teks -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="w-full lg:w-1/2 animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-shadow">Penerimaan Peserta Didik Baru</h1>
                <h2 class="text-3xl md:text-4xl font-semibold mb-6 text-gold">SMK N 2 Siatas Barita</h2>
                <p class="text-lg md:text-xl mb-8">Tahun Ajaran 2026/2027<br>Membangun Generasi Unggul, Siap Kerja, dan Berkarakter</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('pendaftaran.form') }}" class="bg-white text-primary font-semibold py-3 px-6 rounded-full transition-all duration-300 hover:bg-gold hover:text-dark hover:-translate-y-1">
                        <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                    </a>
                    <a href="{{ route('pengumuman.public') }}" class="border-2 border-white text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 hover:bg-white hover:bg-opacity-20 hover:-translate-y-1">
                        <i class="fas fa-bullhorn mr-2"></i>Lihat Pengumuman
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-1/2 mt-10 lg:mt-0 animate-fade-in-up">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                        alt="SMK N 2 Siatas Barita" class="w-full h-auto rounded-xl shadow-2xl">
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Efek Glassmorphism untuk Hero Image */
    .glass-card {
        /* Posisi relatif diperlukan untuk pseudo-element ::before */
        position: relative;
        /* Pastikan konten tidak meluar dari sudut yang melengkung */
        overflow: hidden;
    }

    /* Membuat overlay kaca menggunakan pseudo-element ::before */
    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* Warna background semi-transparan */
        background: rgba(255, 255, 255, 0.25);
        /* Efek blur/buram pada background di belakangnya */
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px); /* Untuk browser Safari */
        /* Border semi-transparan untuk menambah efek kaca */
        border: 1px solid rgba(255, 255, 255, 0.4);
        
        /* Animasi transisi yang halus */
        transition: all 0.4s ease-in-out;
        
        /* Awalnya, overlay kaca tidak terlihat */
        opacity: 0;
    }

    /* Menampilkan overlay kaca saat di-hover */
    .glass-card:hover::before {
        opacity: 1;
    }


    /* Background untuk seluruh halaman agar efek kaca terlihat */
    body {
        background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* Efek Glassmorphism untuk CTA Section */
    .cta-glass-effect {
        background-color: rgba(0, 0, 0, 0.4);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush
<!-- Info Section -->
<section class="py-16 bg-light" id="info">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="animate-fade-in-up">
                <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 h-full">
                    <i class="fas fa-calendar-alt text-4xl text-primary mb-4"></i>
                    <h5 class="text-xl font-semibold mb-2">Jadwal Pendaftaran</h5>
                    <p class="mb-1">1 Januari - 31 Maret 2026</p>
                    <small class="text-muted">Jangan sampai terlewat!</small>
                </div>
            </div>
            <div class="animate-fade-in-up">
                <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 h-full">
                    <i class="fas fa-graduation-cap text-4xl text-primary mb-4"></i>
                    <h5 class="text-xl font-semibold mb-2">18 Jurusan</h5>
                    <p class="mb-1">Berbagai bidang keahlian tersedia</p>
                    <small class="text-muted">Pilihan lengkap untuk masa depan</small>
                </div>
            </div>
            <div class="animate-fade-in-up">
                <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 h-full">
                    <i class="fas fa-users text-4xl text-primary mb-4"></i>
                    <h5 class="text-xl font-semibold mb-2">Kuota Terbatas</h5>
                    <p class="mb-1">36 siswa reguler & 12 siswa unggulan per jurusan</p>
                    <small class="text-muted">Segera daftar!</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jurusan Section -->
<section class="py-16" id="jurusan">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4 text-primary relative inline-block after:content-[''] after:absolute after:-bottom-3 after:left-0 after:w-16 after:h-1 after:bg-gold after:rounded">Program Jurusan</h2>
            <p class="text-lg text-muted max-w-2xl mx-auto">Pilih dari 18 jurusan unggulan dengan berbagai bidang keahlian</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card-jurusan">
                <div class="p-6 flex-grow">
                    <div class="w-16 h-16 rounded-full bg-primary-light flex items-center justify-center text-white text-2xl mb-4">
                        <i class="fas fa-car"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-primary mb-1">Teknik Kendaraan Ringan Otomotif</h5>
                    <p class="text-gold font-medium mb-3">TKRO</p>
                    <p class="text-secondary">Mempelajari perawatan dan perbaikan kendaraan bermotor roda empat.</p>
                </div>
            </div>
            
            <div class="card-jurusan">
                <div class="p-6 flex-grow">
                    <div class="w-16 h-16 rounded-full bg-primary-light flex items-center justify-center text-white text-2xl mb-4">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-primary mb-1">Teknik Sepeda Motor</h5>
                    <p class="text-gold font-medium mb-3">TBSM</p>
                    <p class="text-secondary">Mempelajari perawatan dan perbaikan sepeda motor.</p>
                </div>
            </div>
            
            <div class="card-jurusan">
                <div class="p-6 flex-grow">
                    <div class="w-16 h-16 rounded-full bg-primary-light flex items-center justify-center text-white text-2xl mb-4">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-primary mb-1">Teknik Mekanik Otomotif</h5>
                    <p class="text-gold font-medium mb-3">TSM</p>
                    <p class="text-secondary">Mempelajari mesin dan sistem mekanik pada kendaraan.</p>
                </div>
            </div>
            
            <div class="card-jurusan">
                <div class="p-6 flex-grow">
                    <div class="w-16 h-16 rounded-full bg-primary-light flex items-center justify-center text-white text-2xl mb-4">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-primary mb-1">Teknik Komputer dan Jaringan</h5>
                    <p class="text-gold font-medium mb-3">TKJ</p>
                    <p class="text-secondary">Mempelajari perakitan komputer dan jaringan komputer.</p>
                </div>
            </div>
            
            <div class="card-jurusan">
                <div class="p-6 flex-grow">
                    <div class="w-16 h-16 rounded-full bg-primary-light flex items-center justify-center text-white text-2xl mb-4">
                        <i class="fas fa-code"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-primary mb-1">Rekayasa Perangkat Lunak</h5>
                    <p class="text-gold font-medium mb-3">RPL</p>
                    <p class="text-secondary">Mempelajari pengembangan aplikasi dan software.</p>
                </div>
            </div>
            
            <div class="card-jurusan">
                <div class="p-6 flex-grow">
                    <div class="w-16 h-16 rounded-full bg-primary-light flex items-center justify-center text-white text-2xl mb-4">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-primary mb-1">Teknik Instalasi Tenaga Listrik</h5>
                    <p class="text-gold font-medium mb-3">TITL</p>
                    <p class="text-secondary">Mempelajari pemasangan dan perawatan instalasi listrik.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('jurusan') }}" class="inline-flex items-center gap-2 bg-primary text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 hover:bg-primary-dark hover:-translate-y-1">
                Lihat Semua Jurusan <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>


<!-- CTA Section dengan Efek Kaca -->
<section class="py-16 cta-glass-effect text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Bergabung Dengan Kami?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto">Jangan lewatkan kesempatan untuk menjadi bagian dari SMK N 2 Siatas Barita</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('pendaftaran.form') }}" class="bg-white text-primary font-semibold py-3 px-8 rounded-full transition-all duration-300 hover:bg-gold hover:text-dark hover:-translate-y-1">
                <i class="fas fa-edit mr-2"></i>Daftar Sekarang
            </a>
            <a href="{{ route('kontak') }}" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 hover:bg-white hover:bg-opacity-20 hover:-translate-y-1">
                <i class="fas fa-info-circle mr-2"></i>Informasi Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection