@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-container">
    <!-- Enhanced Page Header -->
    <div class="page-header-modern animate__animated animate__fadeInDown">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-chart-line"></i>
                    Dashboard Overview
                </h1>
                <p class="page-subtitle">
                    <span class="greeting-text">Selamat datang kembali,</span>
                    <strong class="text-gradient">{{ Auth::guard('admin')->user()->nama_lengkap }}</strong>
                </p>
            </div>
            <div class="header-meta">
                <div class="date-display">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="time-display" id="currentTime">
                    <i class="fas fa-clock"></i>
                    <span id="timeText">00:00:00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards - FIXED -->
    <div class="row g-4 mb-4 animate__animated animate__fadeInUp">
        <!-- Total Pendaftar -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern primary">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Total Pendaftar</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $totalSiswa ?? 0 }}">0</h2>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>12%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge primary-badge">
                                <i class="fas fa-check-circle me-1"></i>Semua Jalur
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-chart-mini">
                    <canvas id="chartPendaftar"></canvas>
                </div>
            </div>
        </div>

        <!-- Siswa Diterima -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern success">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Siswa Diterima</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $siswaDiterima ?? 0 }}">0</h2>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>8%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge success-badge">
                                <i class="fas fa-trophy me-1"></i>Telah Diterima
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-chart-mini">
                    <canvas id="chartDiterima"></canvas>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern warning">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Pending Review</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $siswaPending ?? 0 }}">0</h2>
                            <div class="stat-trend neutral">
                                <i class="fas fa-minus"></i>
                                <span>0%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge warning-badge">
                                <i class="fas fa-exclamation-circle me-1"></i>Perlu Verifikasi
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-chart-mini">
                    <canvas id="chartPending"></canvas>
                </div>
            </div>
        </div>

        <!-- Siswa Ditolak -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern danger">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Siswa Ditolak</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $siswaDitolak ?? 0 }}">0</h2>
                            <div class="stat-trend down">
                                <i class="fas fa-arrow-down"></i>
                                <span>4%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge danger-badge">
                                <i class="fas fa-ban me-1"></i>Tidak Lulus
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-chart-mini">
                    <canvas id="chartDitolak"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Modern -->
    <div class="row g-4 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        <div class="col-12">
            <div class="quick-actions-modern">
                <div class="quick-actions-header">
                    <h5 class="quick-actions-title">
                        <i class="fas fa-bolt"></i>
                        Quick Actions
                    </h5>
                    <p class="quick-actions-subtitle">Akses cepat ke fitur utama sistem</p>
                </div>
                <div class="quick-actions-grid">
                    <!-- Data Siswa -->
                    <a href="{{ route('admin.siswa.index') }}" class="quick-action-item primary">
                        <div class="quick-action-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Data Siswa</h6>
                            <p>Kelola pendaftar</p>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <!-- Kelola Jurusan -->
                    <a href="{{ route('admin.jurusan.index') }}" class="quick-action-item success">
                        <div class="quick-action-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Kelola Jurusan</h6>
                            <p>Manajemen program</p>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <!-- Nilai & Seleksi -->
                    <a href="{{ route('admin.nilai.index') }}" class="quick-action-item warning">
                        <div class="quick-action-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Nilai & Seleksi</h6>
                            <p>Proses penilaian</p>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <!-- Laporan -->
                    <a href="{{ route('admin.laporan.index') }}" class="quick-action-item info">
                        <div class="quick-action-icon">
                            <i class="fas fa-file-export"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Laporan</h6>
                            <p>Export & cetak</p>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <!-- Pengumuman -->
                    <a href="{{ route('admin.pengumuman.index') }}" class="quick-action-item danger">
                        <div class="quick-action-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Pengumuman</h6>
                            <p>Publikasi info</p>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <!-- Pengaturan -->
                    <a href="{{ route('admin.pengaturan.index') }}" class="quick-action-item secondary">
                        <div class="quick-action-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Pengaturan</h6>
                            <p>Konfigurasi sistem</p>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Analytics -->
    <div class="row g-4 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
        <!-- Registration Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="analytics-card">
                <div class="analytics-header">
                    <div>
                        <h5 class="analytics-title">
                            <i class="fas fa-chart-area me-2"></i>
                            Statistik Pendaftaran
                        </h5>
                        <p class="analytics-subtitle">Data pendaftaran 6 bulan terakhir</p>
                    </div>
                    <div class="analytics-controls">
                        <button class="btn btn-sm btn-outline-primary active" data-period="6months">6 Bulan</button>
                        <button class="btn btn-sm btn-outline-primary" data-period="year">1 Tahun</button>
                    </div>
                </div>
                <div class="analytics-body">
                    <canvas id="registrationChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Jurusan Distribution -->
        <div class="col-xl-4 col-lg-5">
            <div class="analytics-card">
                <div class="analytics-header">
                    <div>
                        <h5 class="analytics-title">
                            <i class="fas fa-chart-pie me-2"></i>
                            Distribusi Jurusan
                        </h5>
                        <p class="analytics-subtitle">Peminat per jurusan</p>
                    </div>
                </div>
                <div class="analytics-body">
                    <canvas id="jurusanChart" height="300"></canvas>
                </div>
                <div class="analytics-footer">
                    <div class="jurusan-legend">
                        <div class="legend-item">
                            <span class="legend-color" style="background: #0d6efd;"></span>
                            <span>TKJ</span>
                            <strong>45%</strong>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #198754;"></span>
                            <span>RPL</span>
                            <strong>35%</strong>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #ffc107;"></span>
                            <span>MM</span>
                            <strong>20%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & System Info -->
    <div class="row g-4 mb-4 animate__animated animate__fadeInUp animate__delay-3s">
        <!-- Recent Activities -->
        <div class="col-xl-6">
            <div class="activity-card">
                <div class="activity-header">
                    <h5 class="activity-title">
                        <i class="fas fa-history me-2"></i>
                        Aktivitas Terbaru
                    </h5>
                    <a href="#" class="btn btn-sm btn-link">Lihat Semua</a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Pendaftaran Baru</h6>
                            <p>Ahmad Fauzi mendaftar ke jurusan TKJ</p>
                            <span class="activity-time">
                                <i class="fas fa-clock me-1"></i>5 menit yang lalu
                            </span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon primary">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Verifikasi Dokumen</h6>
                            <p>10 dokumen telah diverifikasi</p>
                            <span class="activity-time">
                                <i class="fas fa-clock me-1"></i>15 menit yang lalu
                            </span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Kuota Hampir Penuh</h6>
                            <p>Jurusan RPL mencapai 90% kapasitas</p>
                            <span class="activity-time">
                                <i class="fas fa-clock me-1"></i>1 jam yang lalu
                            </span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Pengumuman Dipublikasi</h6>
                            <p>Info jadwal seleksi telah diumumkan</p>
                            <span class="activity-time">
                                <i class="fas fa-clock me-1"></i>2 jam yang lalu
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Info & Quick Links -->
        <div class="col-xl-6">
            <div class="system-card">
                <div class="system-header">
                    <h5 class="system-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Sistem
                    </h5>
                </div>
                <div class="system-body">
                    <div class="system-info-item">
                        <div class="system-info-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="system-info-content">
                            <h6>Status Database</h6>
                            <div class="d-flex align-items-center">
                                <div class="status-indicator active"></div>
                                <span>Connected & Operational</span>
                            </div>
                        </div>
                    </div>

                    <div class="system-info-item">
                        <div class="system-info-icon">
                            <i class="fas fa-server"></i>
                        </div>
                        <div class="system-info-content">
                            <h6>Server Status</h6>
                            <div class="d-flex align-items-center">
                                <div class="status-indicator active"></div>
                                <span>Online - 99.9% Uptime</span>
                            </div>
                        </div>
                    </div>

                    <div class="system-info-item">
                        <div class="system-info-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="system-info-content">
                            <h6>Security</h6>
                            <div class="d-flex align-items-center">
                                <div class="status-indicator active"></div>
                                <span>All Systems Secure</span>
                            </div>
                        </div>
                    </div>

                    <div class="system-quick-links">
                        <h6 class="mb-3">Quick Links</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="/" class="btn btn-sm btn-outline-primary" target="_blank">
                                <i class="fas fa-external-link-alt me-1"></i>Website
                            </a>
                            <a href="{{ route('admin.backup') }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-file-download me-1"></i>Backup Data
                            </a>
                            <a href="{{ route('admin.bantuan') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-question-circle me-1"></i>Bantuan
                            </a>
                            <a href="{{ route('admin.logout') }}" class="btn btn-sm btn-outline-danger"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Container */
.dashboard-container {
    padding: 2rem 0;
}

/* Enhanced Page Header */
.page-header-modern {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(128, 0, 32, 0.1) 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.page-title-modern {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page-title-modern i {
    color: var(--gold);
    font-size: 1.75rem;
}

.page-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    margin: 0;
}

.greeting-text {
    font-weight: 400;
}

.header-meta {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.date-display, .time-display {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    font-weight: 600;
}

body.dark-mode .date-display,
body.dark-mode .time-display {
    background: #2d2d2d;
}

.date-display i, .time-display i {
    color: var(--gold);
}

/* Modern Stat Cards */
.stat-card-modern {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border: 2px solid transparent;
    height: 100%;
}

body.dark-mode .stat-card-modern {
    background: #2d2d2d;
}

.stat-card-modern:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 45px rgba(0,0,0,0.15);
}

.stat-card-modern.primary {
    border-color: rgba(13, 110, 253, 0.2);
}

.stat-card-modern.success {
    border-color: rgba(25, 135, 84, 0.2);
}

.stat-card-modern.warning {
    border-color: rgba(255, 193, 7, 0.2);
}

.stat-card-modern.info {
    border-color: rgba(23, 162, 184, 0.2);
}

.stat-card-modern:hover.primary {
    border-color: #0d6efd;
    box-shadow: 0 15px 45px rgba(13, 110, 253, 0.3);
}

.stat-card-modern:hover.success {
    border-color: #198754;
    box-shadow: 0 15px 45px rgba(25, 135, 84, 0.3);
}

.stat-card-modern:hover.warning {
    border-color: #ffc107;
    box-shadow: 0 15px 45px rgba(255, 193, 7, 0.3);
}

.stat-card-modern:hover.info {
    border-color: #17a2b8;
    box-shadow: 0 15px 45px rgba(23, 162, 184, 0.3);
}

.stat-card-overlay {
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    transition: all 0.6s ease;
    pointer-events: none;
}

.stat-card-modern:hover .stat-card-overlay {
    transform: rotate(45deg);
}

.stat-card-content {
    position: relative;
    z-index: 1;
}

.stat-icon-wrapper {
    margin-bottom: 1.5rem;
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    transition: all 0.4s ease;
    position: relative;
}

.primary .stat-icon {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.2) 100%);
    color: #0d6efd;
}

.success .stat-icon {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.2) 100%);
    color: #198754;
}

.warning .stat-icon {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%);
    color: #ffc107;
}

.info .stat-icon {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(23, 162, 184, 0.2) 100%);
    color: #17a2b8;
}

.stat-card-modern:hover .stat-icon {
    transform: scale(1.1) rotate(5deg);
}

.stat-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.75rem;
}

.stat-value-wrapper {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    font-family: 'Playfair Display', serif;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
}

.stat-trend.up {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.stat-trend.down {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.stat-trend.neutral {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
}

.stat-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.stat-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

.primary-badge {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}

.success-badge {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.warning-badge {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.info-badge {
    background: rgba(23, 162, 184, 0.1);
    color: #17a2b8;
}

.stat-chart-mini {
    margin-top: 1rem;
    height: 60px;
}

/* Quick Actions Modern */
.quick-actions-modern {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
}

body.dark-mode .quick-actions-modern {
    background: #2d2d2d;
}

.quick-actions-header {
    margin-bottom: 2rem;
}

.quick-actions-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.quick-actions-title i {
    color: var(--gold);
}

.quick-actions-subtitle {
    color: #6c757d;
    margin: 0;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
}

.quick-action-item {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.5rem;
    background: white;
    border-radius: 16px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border: 2px solid;
    position: relative;
    overflow: hidden;
}

body.dark-mode .quick-action-item {
    background: #1a1a1a;
}

.quick-action-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.5s ease;
}

.quick-action-item:hover::before {
    left: 100%;
}

.quick-action-item.primary {
    border-color: rgba(13, 110, 253, 0.2);
}

.quick-action-item.success {
    border-color: rgba(25, 135, 84, 0.2);
}

.quick-action-item.warning {
    border-color: rgba(255, 193, 7, 0.2);
}

.quick-action-item.info {
    border-color: rgba(23, 162, 184, 0.2);
}

.quick-action-item.danger {
    border-color: rgba(220, 53, 69, 0.2);
}

.quick-action-item.secondary {
    border-color: rgba(108, 117, 125, 0.2);
}

.quick-action-item:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.quick-action-item.primary:hover {
    border-color: #0d6efd;
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.1) 100%);
}

.quick-action-item.success:hover {
    border-color: #198754;
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.05) 0%, rgba(25, 135, 84, 0.1) 100%);
}

.quick-action-item.warning:hover {
    border-color: #ffc107;
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.05) 0%, rgba(255, 193, 7, 0.1) 100%);
}

.quick-action-item.info:hover {
    border-color: #17a2b8;
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.05) 0%, rgba(23, 162, 184, 0.1) 100%);
}

.quick-action-item.danger:hover {
    border-color: #dc3545;
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.05) 0%, rgba(220, 53, 69, 0.1) 100%);
}

.quick-action-item.secondary:hover {
    border-color: #6c757d;
    background: linear-gradient(135deg, rgba(108, 117, 125, 0.05) 0%, rgba(108, 117, 125, 0.1) 100%);
}

.quick-action-icon {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.primary .quick-action-icon {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.2) 100%);
    color: #0d6efd;
}

.success .quick-action-icon {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.2) 100%);
    color: #198754;
}

.warning .quick-action-icon {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%);
    color: #ffc107;
}

.info .quick-action-icon {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(23, 162, 184, 0.2) 100%);
    color: #17a2b8;
}

.danger .quick-action-icon {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.2) 100%);
    color: #dc3545;
}

.secondary .quick-action-icon {
    background: linear-gradient(135deg, rgba(108, 117, 125, 0.1) 0%, rgba(108, 117, 125, 0.2) 100%);
    color: #6c757d;
}

.quick-action-item:hover .quick-action-icon {
    transform: scale(1.1) rotate(5deg);
}

.quick-action-content {
    flex: 1;
}

.quick-action-content h6 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: var(--text-dark);
}

body.dark-mode .quick-action-content h6 {
    color: #e0e0e0;
}

.quick-action-content p {
    font-size: 0.9rem;
    color: #6c757d;
    margin: 0;
}

.quick-action-arrow {
    font-size: 1.25rem;
    color: #6c757d;
    transition: all 0.3s ease;
}

.quick-action-item:hover .quick-action-arrow {
    transform: translateX(5px);
    color: inherit;
}

/* Analytics Cards */
.analytics-card {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    height: 100%;
}

body.dark-mode .analytics-card {
    background: #2d2d2d;
}

.analytics-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.analytics-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
}

.analytics-subtitle {
    font-size: 0.9rem;
    color: #6c757d;
    margin: 0;
}

.analytics-controls {
    display: flex;
    gap: 0.5rem;
}

.analytics-body {
    position: relative;
}

.analytics-footer {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 2px solid #e9ecef;
}

body.dark-mode .analytics-footer {
    border-top-color: #444;
}

.jurusan-legend {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
}

.legend-item span {
    flex: 1;
    font-weight: 500;
}

.legend-item strong {
    color: var(--gold);
    font-size: 1.1rem;
}

/* Activity Card */
.activity-card {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    height: 100%;
}

body.dark-mode .activity-card {
    background: #2d2d2d;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.activity-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    gap: 1rem;
    padding: 1.25rem;
    background: #f8f9fa;
    border-radius: 14px;
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

body.dark-mode .activity-item {
    background: #1a1a1a;
}

.activity-item:hover {
    background: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transform: translateX(5px);
}

body.dark-mode .activity-item:hover {
    background: #2d2d2d;
}

.activity-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.activity-icon.primary {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.2) 100%);
    color: #0d6efd;
}

.activity-icon.success {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.2) 100%);
    color: #198754;
}

.activity-icon.warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%);
    color: #ffc107;
}

.activity-icon.info {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(23, 162, 184, 0.2) 100%);
    color: #17a2b8;
}

.activity-content {
    flex: 1;
}

.activity-content h6 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.activity-content p {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.activity-time {
    font-size: 0.85rem;
    color: #adb5bd;
    font-weight: 500;
}

/* System Card */
.system-card {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    height: 100%;
}

body.dark-mode .system-card {
    background: #2d2d2d;
}

.system-header {
    margin-bottom: 1.5rem;
}

.system-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
}

.system-body {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.system-info-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
}

body.dark-mode .system-info-item {
    background: #1a1a1a;
}

.system-info-item:hover {
    background: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

body.dark-mode .system-info-item:hover {
    background: #2d2d2d;
}

.system-info-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.2) 100%);
    color: var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.system-info-content {
    flex: 1;
}

.system-info-content h6 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.status-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 0.5rem;
    animation: pulse-status 2s ease-in-out infinite;
}

.status-indicator.active {
    background: #198754;
    box-shadow: 0 0 10px rgba(25, 135, 84, 0.5);
}

.status-indicator.warning {
    background: #ffc107;
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
}

.status-indicator.danger {
    background: #dc3545;
    box-shadow: 0 0 10px rgba(220, 53, 69, 0.5);
}

@keyframes pulse-status {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.7;
        transform: scale(1.1);
    }
}

.system-quick-links {
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 2px solid #e9ecef;
}

body.dark-mode .system-quick-links {
    border-top-color: #444;
}

.system-quick-links h6 {
    font-weight: 700;
}

/* Responsive */
@media (max-width: 1199.98px) {
    .quick-actions-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 991.98px) {
    .dashboard-container {
        padding: 1.5rem 0;
    }

    .page-header-modern {
        padding: 1.5rem;
    }

    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-title-modern {
        font-size: 1.75rem;
    }

    .header-meta {
        width: 100%;
        justify-content: space-between;
    }

    .stat-card-modern {
        padding: 1.5rem;
    }

    .stat-value {
        font-size: 2rem;
    }

    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767.98px) {
    .page-header-modern {
        padding: 1.25rem;
    }

    .page-title-modern {
        font-size: 1.5rem;
    }

    .page-subtitle {
        font-size: 1rem;
    }

    .date-display, .time-display {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    .stat-card-modern {
        padding: 1.25rem;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 1.75rem;
    }

    .quick-actions-modern {
        padding: 1.5rem;
    }

    .quick-action-item {
        padding: 1.25rem;
    }

    .quick-action-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
    }

    .analytics-card,
    .activity-card,
    .system-card {
        padding: 1.5rem;
    }

    .analytics-controls {
        width: 100%;
        justify-content: space-between;
    }

    .analytics-controls .btn {
        flex: 1;
    }
}

@media (max-width: 575.98px) {
    .dashboard-container {
        padding: 1rem 0;
    }

    .page-header-modern {
        padding: 1rem;
    }

    .header-meta {
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
    }

    .date-display, .time-display {
        width: 100%;
        justify-content: center;
    }

    .stat-card-modern {
        padding: 1rem;
    }

    .quick-actions-modern {
        padding: 1.25rem;
    }

    .quick-actions-title {
        font-size: 1.25rem;
    }

    .system-quick-links .d-flex {
        flex-direction: column;
    }

    .system-quick-links .btn {
        width: 100%;
    }
}
</style>

@endsection

@php
    $labels = $labels ?? ['Mei','Juni','Juli','Agustus','September','Oktober'];
    $pendaftaranData = $pendaftaranData ?? [0,0,0,0,0,0];
    $diterimaData = $diterimaData ?? [0,0,0,0,0,0]; // GANTI: $lulusData -> $diterimaData
    $jurusanLabels = isset($jurusanData) ? $jurusanData->pluck('nama') : collect();
    $jurusanValues = isset($jurusanData) ? $jurusanData->pluck('total_peminat') : collect();
@endphp

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // =====================
    // JAM REAL-TIME
    // =====================
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit' 
        });
        const timeElement = document.getElementById('timeText');
        if (timeElement) timeElement.textContent = timeString;
    }
    updateTime();
    setInterval(updateTime, 1000);

    // =====================
    // ANIMASI COUNTER
    // =====================
    function animateValue(element, start, end, duration) {
        if (!element) return;
        const range = end - start;
        const increment = range / (duration / 16);
        let current = start;
        const timer = setInterval(() => {
            current += increment;
            if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                current = end;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    }

    document.querySelectorAll('.stat-value').forEach(el => {
        if (el.dataset.target) animateValue(el, 0, parseInt(el.dataset.target), 2000);
    });

    // =====================
    // NOTIFIKASI
    // =====================
    function showNotification(message, type = 'info') {
        const notif = document.createElement('div');
        notif.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        Object.assign(notif.style, {
            top: '20px', right: '20px', zIndex: '9999', minWidth: '300px'
        });
        notif.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.body.appendChild(notif);
        setTimeout(() => {
            notif.classList.remove('show');
            setTimeout(() => notif.remove(), 150);
        }, 5000);
    }

    // =====================
    // FETCH DATA DASHBOARD
    // =====================
    function fetchDashboardData() {
        fetch('{{ route("admin.dashboard.data") }}', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(res => res.ok ? res.json() : Promise.reject('Network Error'))
        .then(data => {
            if (data.success) {
                updateDashboardStats(data);
                if (data.recentActivities) updateRecentActivities(data.recentActivities);
            } else {
                showNotification('Gagal memuat data: ' + data.error, 'danger');
            }
        })
        .catch(err => {
            console.error(err);
            showNotification('Terjadi kesalahan saat memuat data', 'danger');
        });
    }

    // =====================
    // UPDATE STATISTIK - FIXED
    // =====================
    function updateDashboardStats(data) {
        const statCards = [
            { selector: '.stat-card-modern.primary .stat-value', value: data.totalSiswa },
            { selector: '.stat-card-modern.success .stat-value', value: data.siswaDiterima }, // GANTI: siswaLulus -> siswaDiterima
            { selector: '.stat-card-modern.warning .stat-value', value: data.siswaPending },
            { selector: '.stat-card-modern.danger .stat-value', value: data.siswaDitolak }, // TAMBAHKAN: siswaDitolak
        ];

        statCards.forEach(card => {
            const el = document.querySelector(card.selector);
            if (!el || card.value === undefined) return;
            const oldVal = parseInt(el.textContent) || 0;
            if (oldVal !== card.value) {
                animateValue(el, oldVal, card.value, 1000);
                const parent = el.closest('.stat-card-modern');
                if (parent) {
                    parent.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => parent.classList.remove('animate__animated', 'animate__pulse'), 1000);
                }
            }
        });
    }

    // =====================
    // UPDATE AKTIVITAS TERBARU
    // =====================
    function updateRecentActivities(activities) {
        const list = document.querySelector('.activity-list');
        if (!list || !activities.length) return;
        list.innerHTML = '';
        activities.forEach((act, i) => {
            let iconClass = 'fa-user-plus', color = 'primary';
            if (act.status === 'Diterima') { iconClass = 'fa-user-check'; color = 'success'; }
            else if (act.status === 'Ditolak') { iconClass = 'fa-user-times'; color = 'danger'; }

            const item = document.createElement('div');
            item.className = 'activity-item animate__animated animate__fadeInLeft';
            item.style.animationDelay = `${i * 0.1}s`;
            item.innerHTML = `
                <div class="activity-icon ${color}"><i class="fas ${iconClass}"></i></div>
                <div class="activity-content">
                    <h6>${act.status === 'Diterima' ? 'Siswa Diterima' : act.status === 'Ditolak' ? 'Siswa Ditolak' : 'Pendaftaran Baru'}</h6>
                    <p>${act.nama} - ${act.jurusan}</p>
                    <span class="activity-time"><i class="fas fa-clock me-1"></i>${act.waktu}</span>
                </div>
            `;
            list.appendChild(item);
        });
    }

    // =====================
    // REALTIME UPDATE (Echo)
    // =====================
    function setupRealTimeUpdates() {
        setInterval(fetchDashboardData, 30000);
        if (typeof Echo !== 'undefined') {
            Echo.channel('ppdb-updates')
                .listen('NewRegistration', e => {
                    showNotification(`Pendaftaran baru: ${e.siswa.nama}`, 'info');
                    fetchDashboardData();
                })
                .listen('StatusUpdated', e => {
                    showNotification(`Status diperbarui: ${e.siswa.nama}`, 'success');
                    fetchDashboardData();
                });
        }
    }
    setupRealTimeUpdates();
    fetchDashboardData();

    // =====================
    // INISIALISASI CHART - FIXED
    // =====================
    if (typeof Chart !== 'undefined') {
        const chartOptions = {
            type: 'line',
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { display: false }, y: { display: false } },
                elements: { line: { borderWidth: 2, tension: 0.4 }, point: { radius: 0 } }
            }
        };

        const charts = [
            { id: 'chartPendaftar', color: '#0d6efd', data: [12, 19, 15, 25, 22, 30] },
            { id: 'chartDiterima', color: '#198754', data: [8, 12, 10, 18, 15, 22] }, // GANTI: chartLulus -> chartDiterima
            { id: 'chartPending', color: '#ffc107', data: [4, 7, 5, 7, 7, 8] },
            { id: 'chartDitolak', color: '#dc3545', data: [2, 3, 2, 4, 3, 5] }, // TAMBAHKAN: chartDitolak
        ];
        charts.forEach(c => {
            const el = document.getElementById(c.id);
            if (el) {
                new Chart(el, {
                    ...chartOptions,
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            data: c.data,
                            borderColor: c.color,
                            backgroundColor: c.color.replace(')', ', 0.1)').replace('#', 'rgba('),
                            fill: true
                        }]
                    }
                });
            }
        });

        // Chart Pendaftaran - FIXED
        const registrationChartElement = document.getElementById('registrationChart');
        if (registrationChartElement) {
            new Chart(registrationChartElement, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Total Pendaftar',
                            data: @json($pendaftaranData),
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Diterima', // GANTI: Lulus -> Diterima
                            data: @json($diterimaData), // GANTI: $lulusData -> $diterimaData
                            borderColor: '#198754',
                            backgroundColor: 'rgba(25, 135, 84, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: { size: 12, weight: '600' }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0, 0, 0, 0.05)' }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // Chart Jurusan
        const jurusanChartElement = document.getElementById('jurusanChart');
        if (jurusanChartElement) {
            const jurusanLabels = @json($jurusanLabels);
            const jurusanValues = @json($jurusanValues);

            const labels = jurusanLabels.length > 0 ? jurusanLabels : ['TKJ', 'RPL', 'MM'];
            const values = jurusanValues.length > 0 ? jurusanValues : [45, 35, 20];

            new Chart(jurusanChartElement, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#6c757d'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: { size: 14, weight: '600' },
                            bodyFont: { size: 13 },
                            cornerRadius: 8
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    }

    // =====================
    // ANIMASI TAMBAHAN
    // =====================
    document.querySelectorAll('.quick-action-item').forEach(item => {
        item.addEventListener('mouseenter', () => item.style.transform = 'translateX(8px)');
        item.addEventListener('mouseleave', () => item.style.transform = 'translateX(0)');
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.style.animation = 'fadeInLeft 0.5s ease forwards', i * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.activity-item').forEach(item => observer.observe(item));

    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush
