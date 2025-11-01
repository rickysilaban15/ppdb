@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="laporan-container">
    <!-- Enhanced Page Header -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-file-export"></i>
                    Laporan
                </h1>
                <p class="page-subtitle">
                    Generate laporan dan ekspor data PPDB
                </p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Cetak Halaman
                </button>
            </div>
        </div>
    </div>

    <!-- Export Options Section -->
    <div class="export-section">
        <h2 class="section-title">
            <i class="fas fa-download me-2"></i>Opsi Ekspor Data
        </h2>
        <div class="export-options">
            <div class="export-card excel-card">
                <div class="export-card-content">
                    <div class="export-icon-wrapper">
                        <div class="export-icon excel">
                            <i class="fas fa-file-excel"></i>
                        </div>
                    </div>
                    <div class="export-details">
                        <h3>Export Excel</h3>
                        <p>Ekspor data siswa ke format Excel dengan detail lengkap</p>
                        <div class="export-features">
                            <span class="feature-tag">
                                <i class="fas fa-check me-1"></i>Data Lengkap
                            </span>
                            <span class="feature-tag">
                                <i class="fas fa-check me-1"></i>Multi Sheet
                            </span>
                        </div>
                        <div class="export-actions">
                            <a href="{{ route('admin.laporan.exportExcel', ['type' => 'all']) }}" class="btn btn-excel">
                                <i class="fas fa-download me-2"></i>Download All
                            </a>
                            <button class="btn btn-outline-excel" onclick="showExcelOptions()">
                                <i class="fas fa-cog me-2"></i>Pilihan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="export-card pdf-card">
                <div class="export-card-content">
                    <div class="export-icon-wrapper">
                        <div class="export-icon pdf">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                    </div>
                    <div class="export-details">
                        <h3>Export PDF</h3>
                        <p>Ekspor data ke format PDF siap cetak dengan format profesional</p>
                        <div class="export-features">
                            <span class="feature-tag">
                                <i class="fas fa-check me-1"></i>Siap Cetak
                            </span>
                            <span class="feature-tag">
                                <i class="fas fa-check me-1"></i>Header/Footer
                            </span>
                        </div>
                        <div class="export-actions">
                            <a href="{{ route('admin.laporan.exportPdf', ['type' => 'all']) }}" class="btn btn-pdf">
                                <i class="fas fa-download me-2"></i>Download All
                            </a>
                            <button class="btn btn-outline-pdf" onclick="showPdfOptions()">
                                <i class="fas fa-cog me-2"></i>Pilihan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="statistics-section">
        <h2 class="section-title">
            <i class="fas fa-chart-pie me-2"></i>Statistik PPDB
        </h2>
        
        <!-- Chart Statistics -->
        <div class="chart-statistics">
            <div class="row">
                <!-- Jalur Pendaftaran Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-title">
                                <i class="fas fa-route me-2"></i>Distribusi Jalur Pendaftaran
                            </h5>
                            <div class="chart-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="refreshChart('jalurChart')">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-card-body">
                            <canvas id="jalurChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Status Kelulusan Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-title">
                                <i class="fas fa-clipboard-check me-2"></i>Status Kelulusan
                            </h5>
                            <div class="chart-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="refreshChart('kelulusanChart')">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-card-body">
                            <canvas id="kelulusanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jurusan Statistics Chart -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-title">
                                <i class="fas fa-school me-2"></i>Statistik Peminat & Diterima per Jurusan
                            </h5>
                            <div class="chart-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="refreshChart('jurusanChart')">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary active" onclick="toggleJurusanChart('bar')">Bar</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="toggleJurusanChart('line')">Line</button>
                                </div>
                            </div>
                        </div>
                        <div class="chart-card-body">
                            <canvas id="jurusanChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Number Statistics -->
        <div class="statistics-grid">
            <div class="stat-main">
                <div class="stat-card-modern primary">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Total Siswa</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value" data-target="{{ $stats['total_siswa'] ?? 0 }}">0</h2>
                                <div class="stat-trend up">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Pendaftar</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge primary-badge">
                                    <i class="fas fa-database me-1"></i>Semua Data
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar-modern primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <div class="stat-grid">
                <div class="stat-card-modern success">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Lulus</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value" data-target="{{ $stats['lulus'] ?? 0 }}">0</h2>
                                <div class="stat-trend up">
                                    <i class="fas fa-percentage"></i>
                                    <span>{{ $stats['total_siswa'] > 0 ? round(($stats['lulus'] / $stats['total_siswa']) * 100) : 0 }}%</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge success-badge">
                                    <i class="fas fa-graduation-cap me-1"></i>Diterima
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar-modern success" style="width: {{ $stats['total_siswa'] > 0 ? round(($stats['lulus'] / $stats['total_siswa']) * 100) : 0 }}%"></div>
                    </div>
                </div>

                <div class="stat-card-modern warning">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Pending</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value" data-target="{{ $stats['pending'] ?? 0 }}">0</h2>
                                <div class="stat-trend neutral">
                                    <i class="fas fa-hourglass-half"></i>
                                    <span>Review</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge warning-badge">
                                    <i class="fas fa-sync me-1"></i>Proses
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar-modern warning" style="width: {{ $stats['total_siswa'] > 0 ? round(($stats['pending'] / $stats['total_siswa']) * 100) : 0 }}%"></div>
                    </div>
                </div>

                <div class="stat-card-modern info">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Total Jurusan</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value" data-target="{{ $jurusans->count() ?? 0 }}">0</h2>
                                <div class="stat-trend up">
                                    <i class="fas fa-book"></i>
                                    <span>Program</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge info-badge">
                                    <i class="fas fa-graduation-cap me-1"></i>Keahlian
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar-modern info" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jalur Pendaftaran Statistics -->
    <div class="jalur-section">
        <h2 class="section-title">
            <i class="fas fa-route me-2"></i>Distribusi Jalur Pendaftaran
        </h2>
        <div class="jalur-stats">
            <div class="jalur-stat">
                <div class="jalur-icon zonasi">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="jalur-content">
                    <h4>Zonasi</h4>
                    <div class="jalur-value">{{ $stats['zonasi'] ?? 0 }}</div>
                    <div class="jalur-percent">{{ $stats['total_siswa'] > 0 ? round(($stats['zonasi'] / $stats['total_siswa']) * 100) : 0 }}%</div>
                </div>
                <div class="jalur-progress">
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: {{ $stats['total_siswa'] > 0 ? round(($stats['zonasi'] / $stats['total_siswa']) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="jalur-stat">
                <div class="jalur-icon prestasi">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="jalur-content">
                    <h4>Prestasi</h4>
                    <div class="jalur-value">{{ $stats['prestasi'] ?? 0 }}</div>
                    <div class="jalur-percent">{{ $stats['total_siswa'] > 0 ? round(($stats['prestasi'] / $stats['total_siswa']) * 100) : 0 }}%</div>
                </div>
                <div class="jalur-progress">
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $stats['total_siswa'] > 0 ? round(($stats['prestasi'] / $stats['total_siswa']) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="jalur-stat">
                <div class="jalur-icon afirmasi">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="jalur-content">
                    <h4>Afirmasi</h4>
                    <div class="jalur-value">{{ $stats['afirmasi'] ?? 0 }}</div>
                    <div class="jalur-percent">{{ $stats['total_siswa'] > 0 ? round(($stats['afirmasi'] / $stats['total_siswa']) * 100) : 0 }}%</div>
                </div>
                <div class="jalur-progress">
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ $stats['total_siswa'] > 0 ? round(($stats['afirmasi'] / $stats['total_siswa']) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="jalur-stat">
                <div class="jalur-icon mutasi">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="jalur-content">
                    <h4>Mutasi</h4>
                    <div class="jalur-value">{{ $stats['mutasi'] ?? 0 }}</div>
                    <div class="jalur-percent">{{ $stats['total_siswa'] > 0 ? round(($stats['mutasi'] / $stats['total_siswa']) * 100) : 0 }}%</div>
                </div>
                <div class="jalur-progress">
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: {{ $stats['total_siswa'] > 0 ? round(($stats['mutasi'] / $stats['total_siswa']) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-section">
        <h2 class="section-title">
            <i class="fas fa-bolt me-2"></i>Aksi Cepat
        </h2>
        <div class="quick-actions">
            <a href="{{ route('admin.laporan.statistik') }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Lihat Statistik</h4>
                    <p>Grafik dan analisis lengkap</p>
                </div>
            </a>

            <a href="{{ route('admin.laporan.exportExcel', ['type' => 'siswa']) }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-file-excel"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Data Siswa</h4>
                    <p>Export data siswa saja</p>
                </div>
            </a>

            <a href="{{ route('admin.laporan.exportPdf', ['type' => 'kelulusan']) }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Laporan Kelulusan</h4>
                    <p>Hasil seleksi PPDB</p>
                </div>
            </a>

            <a href="{{ route('admin.laporan.exportPdf', ['type' => 'jurusan']) }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Data Jurusan</h4>
                    <p>Kapasitas & peminat</p>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
/* ================================
   ROOT VARIABLES
   ================================ */
:root {
    --bg-primary: #f8f9fa;
    --bg-secondary: #ffffff;
    --bg-tertiary: #e9ecef;
    --text-primary: #212529;
    --text-secondary: #6c757d;
    --text-muted: #adb5bd;
    --border-color: #dee2e6;
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.12);
    --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.15);
    --gold: #D4AF37;
    --gold-dark: #B8941F;
    --gold-light: #F4D03F;
    --primary: #0d6efd;
    --success: #198754;
    --warning: #ffc107;
    --danger: #dc3545;
    --info: #0dcaf0;
    --excel: #217346;
    --pdf: #e74c3c;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ================================
   CONTAINER
   ================================ */
.laporan-container {
    padding: 2rem 0;
    animation: fadeIn 0.5s ease-in-out;
}

/* ================================
   PAGE HEADER
   ================================ */
.page-header-modern {
    background: var(--bg-secondary);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    transition: var(--transition);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.page-title-modern {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-title-modern i {
    color: var(--gold);
    font-size: 2.5rem;
    animation: pulse 2s infinite;
}

.page-subtitle {
    color: var(--text-secondary);
    margin: 0.5rem 0 0;
    font-size: 1rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
}

/* ================================
   SECTION TITLES
   ================================ */
.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
}

.section-title i {
    color: var(--gold);
    margin-right: 0.75rem;
}

/* ================================
   EXPORT SECTION
   ================================ */
.export-section {
    margin-bottom: 3rem;
}

.export-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.export-card {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
    height: 100%;
}

.export-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.export-card-content {
    padding: 2rem;
    display: flex;
    gap: 2rem;
    align-items: center;
}

.export-icon-wrapper {
    flex-shrink: 0;
}

.export-icon {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.excel {
    background: linear-gradient(135deg, var(--excel) 0%, #2e7d32 100%);
    box-shadow: 0 8px 20px rgba(33, 115, 70, 0.3);
}

.pdf {
    background: linear-gradient(135deg, var(--pdf) 0%, #c0392b 100%);
    box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
}

.export-icon::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shine 3s infinite;
}

.export-details {
    flex: 1;
}

.export-details h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
}

.export-details p {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.export-features {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.feature-tag {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    background: var(--bg-tertiary);
    color: var(--text-secondary);
    display: inline-flex;
    align-items: center;
}

.export-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-excel {
    background: linear-gradient(135deg, var(--excel) 0%, #2e7d32 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: var(--transition);
}

.btn-excel:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(33, 115, 70, 0.3);
}

.btn-outline-excel {
    background: transparent;
    border: 2px solid var(--excel);
    color: var(--excel);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: var(--transition);
}

.btn-outline-excel:hover {
    background: var(--excel);
    color: white;
}

.btn-pdf {
    background: linear-gradient(135deg, var(--pdf) 0%, #c0392b 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: var(--transition);
}

.btn-pdf:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
}

.btn-outline-pdf {
    background: transparent;
    border: 2px solid var(--pdf);
    color: var(--pdf);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: var(--transition);
}

.btn-outline-pdf:hover {
    background: var(--pdf);
    color: white;
}

/* ================================
   CHART SECTION
   ================================ */
.chart-statistics {
    margin-bottom: 3rem;
}

.chart-card {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
}

.chart-card:hover {
    box-shadow: var(--shadow-lg);
}

.chart-card-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chart-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
}

.chart-title i {
    color: var(--gold);
    margin-right: 0.75rem;
}

.chart-actions {
    display: flex;
    gap: 0.5rem;
}

.chart-card-body {
    padding: 1.5rem;
    position: relative;
    height: 300px;
}

/* ================================
   STATISTICS SECTION
   ================================ */
.statistics-section {
    margin-bottom: 3rem;
}

.statistics-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

.stat-main {
    grid-column: span 1;
}

.stat-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

.stat-card-modern {
    background: var(--bg-secondary);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    position: relative;
    overflow: hidden;
    transition: var(--transition);
    height: 100%;
}

.stat-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-card-overlay {
    position: absolute;
    top: 0;
    right: 0;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(50%, -50%);
    pointer-events: none;
}

.stat-card-content {
    position: relative;
    z-index: 1;
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.stat-icon-wrapper {
    flex-shrink: 0;
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.stat-card-modern.primary .stat-icon {
    background: linear-gradient(135deg, var(--primary) 0%, #0a58ca 100%);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
}

.stat-card-modern.success .stat-icon {
    background: linear-gradient(135deg, var(--success) 0%, #146c43 100%);
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.3);
}

.stat-card-modern.warning .stat-icon {
    background: linear-gradient(135deg, var(--warning) 0%, #ffca2c 100%);
    box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
}

.stat-card-modern.info .stat-icon {
    background: linear-gradient(135deg, var(--info) 0%, #31d2f2 100%);
    box-shadow: 0 8px 20px rgba(13, 202, 240, 0.3);
}

.stat-icon::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shine 3s infinite;
}

.stat-details {
    flex: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 600;
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    color: var(--text-primary);
    margin: 0;
    line-height: 1;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
}

.stat-trend.up {
    background: rgba(25, 135, 84, 0.1);
    color: var(--success);
}

.stat-trend.neutral {
    background: rgba(255, 193, 7, 0.1);
    color: var(--warning);
}

.stat-badge {
    padding: 0.5rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
}

.primary-badge {
    background: rgba(13, 110, 253, 0.1);
    color: var(--primary);
}

.success-badge {
    background: rgba(25, 135, 84, 0.1);
    color: var(--success);
}

.warning-badge {
    background: rgba(255, 193, 7, 0.1);
    color: var(--warning);
}

.info-badge {
    background: rgba(13, 202, 240, 0.1);
    color: var(--info);
}

.stat-progress {
    height: 6px;
    background: var(--bg-tertiary);
    border-radius: 10px;
    overflow: hidden;
    margin-top: 1.5rem;
}

.progress-bar-modern {
    height: 100%;
    transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.progress-bar-modern.primary {
    background: linear-gradient(90deg, var(--primary) 0%, #0a58ca 100%);
}

.progress-bar-modern.success {
    background: linear-gradient(90deg, var(--success) 0%, #146c43 100%);
}

.progress-bar-modern.warning {
    background: linear-gradient(90deg, var(--warning) 0%, #ffca2c 100%);
}

.progress-bar-modern.info {
    background: linear-gradient(90deg, var(--info) 0%, #31d2f2 100%);
}

/* ================================
   JALUR SECTION
   ================================ */
.jalur-section {
    margin-bottom: 3rem;
}

.jalur-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.jalur-stat {
    background: var(--bg-secondary);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    transition: var(--transition);
}

.jalur-stat:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.jalur-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.jalur-icon.zonasi {
    background: linear-gradient(135deg, var(--primary) 0%, #0a58ca 100%);
}

.jalur-icon.prestasi {
    background: linear-gradient(135deg, var(--success) 0%, #146c43 100%);
}

.jalur-icon.afirmasi {
    background: linear-gradient(135deg, var(--warning) 0%, #ffca2c 100%);
}

.jalur-icon.mutasi {
    background: linear-gradient(135deg, var(--info) 0%, #31d2f2 100%);
}

.jalur-content h4 {
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.jalur-value {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.jalur-percent {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.jalur-progress .progress {
    height: 8px;
    background: var(--bg-tertiary);
    border-radius: 10px;
    overflow: hidden;
}

/* ================================
   QUICK ACTIONS SECTION
   ================================ */
.quick-actions-section {
    margin-bottom: 3rem;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.quick-action {
    background: var(--bg-secondary);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    text-decoration: none;
    color: inherit;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.quick-action:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    color: var(--gold);
}

.quick-action-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.quick-action-content h4 {
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.quick-action-content p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0;
}

/* ================================
   ANIMATIONS
   ================================ */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

@keyframes shine {
    0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
    }
    100% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
    }
}

/* ================================
   RESPONSIVE DESIGN
   ================================ */
@media (max-width: 1199.98px) {
    .statistics-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-main {
        grid-column: span 1;
    }
    
    .stat-value {
        font-size: 2rem;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}

@media (max-width: 991.98px) {
    .laporan-container {
        padding: 1.5rem 0;
    }

    .page-header-modern {
        padding: 1.5rem;
    }

    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .header-actions {
        width: 100%;
        justify-content: space-between;
    }

    .export-options {
        grid-template-columns: 1fr;
    }

    .export-card-content {
        flex-direction: column;
        text-align: center;
    }

    .export-actions {
        justify-content: center;
    }

    .stat-value {
        font-size: 1.8rem;
    }
}

@media (max-width: 767.98px) {
    .page-title-modern {
        font-size: 1.5rem;
    }

    .page-title-modern i {
        font-size: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .jalur-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-value {
        font-size: 2rem;
    }
    
    .chart-card-body {
        height: 250px;
    }
}

@media (max-width: 575.98px) {
    .laporan-container {
        padding: 1rem 0;
    }

    .page-header-modern {
        padding: 1.25rem;
    }

    .header-actions {
        flex-direction: column;
    }

    .export-card-content {
        padding: 1.5rem;
    }

    .jalur-stats {
        grid-template-columns: 1fr;
    }

    .quick-actions {
        grid-template-columns: 1fr;
    }

    .stat-value {
        font-size: 1.8rem;
    }
}

/* ================================
   PRINT STYLES
   ================================ */
@media print {
    .page-header-modern,
    .export-section,
    .quick-actions-section {
        display: none !important;
    }

    .statistics-section,
    .jalur-section {
        box-shadow: none;
        border: 1px solid #ddd;
    }
}
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animated counter for stat cards
    function animateValue(element, start, end, duration) {
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

    document.querySelectorAll('.stat-value').forEach(element => {
        const target = parseInt(element.dataset.target);
        animateValue(element, 0, target, 2000);
    });

    // Animate progress bars
    setTimeout(() => {
        document.querySelectorAll('.progress-bar').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    }, 500);

    // Initialize Charts
    initializeCharts();
});

// Chart Configuration
function initializeCharts() {
    // Jalur Pendaftaran Chart
    const jalurCtx = document.getElementById('jalurChart').getContext('2d');
    window.jalurChart = new Chart(jalurCtx, {
        type: 'doughnut',
        data: {
            labels: ['Zonasi', 'Prestasi', 'Afirmasi', 'Mutasi'],
            datasets: [{
                data: [
                    {{ $stats['zonasi'] ?? 0 }},
                    {{ $stats['prestasi'] ?? 0 }},
                    {{ $stats['afirmasi'] ?? 0 }},
                    {{ $stats['mutasi'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.8)',
                    'rgba(25, 135, 84, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(13, 202, 240, 0.8)'
                ],
                borderColor: [
                    'rgba(13, 110, 253, 1)',
                    'rgba(25, 135, 84, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(13, 202, 240, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    });

    // Status Kelulusan Chart
    const kelulusanCtx = document.getElementById('kelulusanChart').getContext('2d');
    window.kelulusanChart = new Chart(kelulusanCtx, {
        type: 'pie',
        data: {
            labels: ['Lulus', 'Tidak Lulus', 'Pending'],
            datasets: [{
                data: [
                    {{ $stats['lulus'] ?? 0 }},
                    {{ $stats['tidak_lulus'] ?? 0 }},
                    {{ $stats['pending'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(25, 135, 84, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)'
                ],
                borderColor: [
                    'rgba(25, 135, 84, 1)',
                    'rgba(220, 53, 69, 1)',
                    'rgba(255, 193, 7, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    });

    // Jurusan Statistics Chart
    const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
    
    // Prepare data for jurusan chart
    const jurusanLabels = [];
    const jurusanPeminat1 = [];
    const jurusanPeminat2 = [];
    const jurusanDiterima = [];

    @foreach($jurusans as $jurusan)
        jurusanLabels.push('{{ $jurusan->nama_jurusan }}');
        jurusanPeminat1.push({{ $jurusan->peminat_1 ?? 0 }});
        jurusanPeminat2.push({{ $jurusan->peminat_2 ?? 0 }});
        jurusanDiterima.push({{ $jurusan->diterima ?? 0 }});
    @endforeach

    window.jurusanChart = new Chart(jurusanCtx, {
        type: 'bar',
        data: {
            labels: jurusanLabels,
            datasets: [
                {
                    label: 'Peminat Pilihan 1',
                    data: jurusanPeminat1,
                    backgroundColor: 'rgba(13, 110, 253, 0.8)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Peminat Pilihan 2',
                    data: jurusanPeminat2,
                    backgroundColor: 'rgba(13, 202, 240, 0.8)',
                    borderColor: 'rgba(13, 202, 240, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Diterima',
                    data: jurusanDiterima,
                    backgroundColor: 'rgba(25, 135, 84, 0.8)',
                    borderColor: 'rgba(25, 135, 84, 1)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });
}

// Refresh chart function
function refreshChart(chartId) {
    const chart = window[chartId];
    if (chart) {
        chart.update('active');
        
        // Show notification
        showNotification('Chart berhasil diperbarui', 'success');
    }
}

// Toggle jurusan chart type
function toggleJurusanChart(type) {
    const chart = window.jurusanChart;
    if (chart) {
        chart.config.type = type;
        chart.update();
        
        // Update button states
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');
    }
}

// Show Excel export options
function showExcelOptions() {
    Swal.fire({
        title: 'Pilih Jenis Laporan Excel',
        html: `
            <div class="text-start">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.laporan.exportExcel', ['type' => 'all']) }}" class="btn btn-success">
                        <i class="fas fa-file-excel me-2"></i>Laporan Lengkap (All Data)
                    </a>
                    <a href="{{ route('admin.laporan.exportExcel', ['type' => 'siswa']) }}" class="btn btn-primary">
                        <i class="fas fa-user-graduate me-2"></i>Data Siswa Saja
                    </a>
                    <a href="{{ route('admin.laporan.exportExcel', ['type' => 'jurusan']) }}" class="btn btn-info">
                        <i class="fas fa-school me-2"></i>Data Jurusan Saja
                    </a>
                    <a href="{{ route('admin.laporan.exportExcel', ['type' => 'kelulusan']) }}" class="btn btn-warning">
                        <i class="fas fa-clipboard-check me-2"></i>Data Kelulusan Saja
                    </a>
                </div>
            </div>
        `,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Tutup',
        cancelButtonColor: '#6c757d',
        width: '500px',
        background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
        color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
    });
}

// Show PDF export options
function showPdfOptions() {
    Swal.fire({
        title: 'Pilih Jenis Laporan PDF',
        html: `
            <div class="text-start">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.laporan.exportPdf', ['type' => 'all']) }}" class="btn btn-danger">
                        <i class="fas fa-file-pdf me-2"></i>Laporan Lengkap (All Data)
                    </a>
                    <a href="{{ route('admin.laporan.exportPdf', ['type' => 'siswa']) }}" class="btn btn-primary">
                        <i class="fas fa-user-graduate me-2"></i>Data Siswa Saja
                    </a>
                    <a href="{{ route('admin.laporan.exportPdf', ['type' => 'jurusan']) }}" class="btn btn-info">
                        <i class="fas fa-school me-2"></i>Data Jurusan Saja
                    </a>
                    <a href="{{ route('admin.laporan.exportPdf', ['type' => 'kelulusan']) }}" class="btn btn-warning">
                        <i class="fas fa-clipboard-check me-2"></i>Data Kelulusan Saja
                    </a>
                </div>
            </div>
        `,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Tutup',
        cancelButtonColor: '#6c757d',
        width: '500px',
        background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
        color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
    });
}

// Show notification function
function showNotification(message, type = 'success') {
    const bgColors = {
        success: '#198754',
        danger: '#dc3545',
        warning: '#ffc107',
        info: '#0dcaf0',
        primary: '#0d6efd'
    };

    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white border-0';
    toast.style.backgroundColor = bgColors[type];
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'times-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    // Create container if it doesn't exist
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }
    
    container.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast, {
        autohide: true,
        delay: 5000
    });
    
    bsToast.show();
    
    // Remove toast element after it's hidden
    toast.addEventListener('hidden.bs.toast', function() {
        toast.remove();
    });
}

// Handle window resize for responsive design
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Resize charts
        if (window.jalurChart) window.jalurChart.resize();
        if (window.kelulusanChart) window.kelulusanChart.resize();
        if (window.jurusanChart) window.jurusanChart.resize();
    }, 250);
});

// Add loading state to export buttons
document.querySelectorAll('a[href*="export"]').forEach(link => {
    link.addEventListener('click', function(e) {
        // Show loading notification
        Swal.fire({
            title: 'Memproses...',
            html: `
                <div class="text-center">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Sedang menyiapkan laporan...</p>
                </div>
            `,
            allowOutsideClick: false,
            showConfirmButton: false,
            background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
            color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary'),
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Auto close after 2 seconds
        setTimeout(() => {
            Swal.close();
        }, 2000);
    });
});

// Success/Error message handling
@if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonColor: '#D4AF37',
        background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
        color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
    });
@endif

@if(session('error'))
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonColor: '#dc3545',
        background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
        color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
    });
@endif

console.log('%c📊 Laporan Module with Charts Loaded Successfully! ', 'background: #D4AF37; color: white; font-size: 16px; padding: 10px; border-radius: 5px;');
</script>
@endsection