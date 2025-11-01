@extends('layouts.admin')

@section('title', 'Nilai & Seleksi')

@section('content')
<div class="nilai-seleksi-container">
    <!-- Enhanced Page Header -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-chart-bar"></i>
                    Nilai & Seleksi
                </h1>
                <p class="page-subtitle">
                    Proses penilaian dan seleksi calon siswa
                </p>
            </div>
            <!-- Di header-actions -->
<div class="header-actions">
    <form action="{{ route('admin.nilai.seleksi.proses') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-premium">
            <i class="fas fa-calculator me-2"></i>Proses Seleksi
        </button>
    </form>
    
    <form action="{{ route('admin.nilai.ranking.proses') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-gold">
            <i class="fas fa-trophy me-2"></i>Proses Ranking
        </button>
    </form>
</div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="stats-overview">
        <div class="row g-4">
            <div class="col-xl-4 col-lg-6">
                <div class="stat-card-modern primary">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Proses Seleksi</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value">Auto</h2>
                                <div class="stat-trend up">
                                    <i class="fas fa-robot"></i>
                                    <span>Otomatis</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge primary-badge">
                                    <i class="fas fa-check-double me-1"></i>Berdasarkan Nilai
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar-modern primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="stat-card-modern success">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Perangkingan</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value">Rank</h2>
                                <div class="stat-trend up">
                                    <i class="fas fa-sort-amount-up"></i>
                                    <span>Skor Tertinggi</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge success-badge">
                                    <i class="fas fa-medal me-1"></i>Urutkan Otomatis
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar-modern success" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="stat-card-modern info">
                    <div class="stat-card-overlay"></div>
                    <div class="stat-card-content">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="stat-details">
                            <h6 class="stat-label">Analisis</h6>
                            <div class="stat-value-wrapper">
                                <h2 class="stat-value">Data</h2>
                                <div class="stat-trend neutral">
                                    <i class="fas fa-chart-pie"></i>
                                    <span>Statistik</span>
                                </div>
                            </div>
                            <div class="stat-footer">
                                <span class="badge stat-badge info-badge">
                                    <i class="fas fa-analytics me-1"></i>Visualisasi
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

    <!-- Enhanced Information Section -->
    <div class="info-section">
        <div class="info-card">
            <div class="info-card-content">
                <div class="info-icon-wrapper">
                    <div class="info-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                </div>
                <div class="info-details">
                    <h3 class="info-title">Sistem Seleksi Otomatis</h3>
                    <p class="info-description">
                        Sistem akan secara otomatis memproses seleksi berdasarkan nilai rapor, 
                        akreditasi sekolah, dan kriteria lainnya sesuai dengan ketentuan PPDB.
                    </p>
                    <div class="info-actions">
    <form action="{{ route('admin.nilai.seleksi.proses') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-play me-2"></i>Jalankan Seleksi
        </button>
    </form>
    
    <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-users me-2"></i>Lihat Data Siswa
    </a>
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Flow Section -->
    <div class="process-flow-section">
        <h2 class="section-title">Alur Proses Seleksi</h2>
        <div class="process-flow">
            <div class="process-step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4>Input Data</h4>
                    <p>Masukkan data siswa dan nilai rapor</p>
                </div>
            </div>
            
            <div class="process-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
            
            <div class="process-step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h4>Proses Seleksi</h4>
                    <p>Hitung skor berdasarkan kriteria</p>
                </div>
            </div>
            
            <div class="process-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
            
            <div class="process-step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4>Perangkingan</h4>
                    <p>Urutkan siswa berdasarkan skor</p>
                </div>
            </div>
            
            <div class="process-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
            
            <div class="process-step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4>Hasil Akhir</h4>
                    <p>Tentukan siswa yang diterima</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="quick-stats-section">
        <h2 class="section-title">Statistik Cepat</h2>
        <div class="quick-stats">
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="quick-stat-content">
                    <h3>{{ App\Models\Siswa::count() }}</h3>
                    <p>Total Siswa</p>
                </div>
            </div>
            
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="quick-stat-content">
                    <h3>{{ App\Models\Siswa::where('status_kelulusan', 'lulus')->count() }}</h3>
                    <p>Siswa Lulus</p>
                </div>
            </div>
            
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="quick-stat-content">
                    <h3>{{ App\Models\Siswa::where('status_kelulusan', 'pending')->count() }}</h3>
                    <p>Menunggu Proses</p>
                </div>
            </div>
            
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <div class="quick-stat-content">
                    <h3>{{ App\Models\Siswa::whereNotNull('ranking')->count() }}</h3>
                    <p>Teranking</p>
                </div>
            </div>
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
    --premium: #6f42c1;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ================================
   CONTAINER
   ================================ */
.nilai-seleksi-container {
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
   BUTTONS
   ================================ */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

.btn-premium {
    background: linear-gradient(135deg, var(--premium) 0%, #5a32a3 100%);
    color: white;
}

.btn-premium:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(111, 66, 193, 0.3);
}

.btn-gold {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: white;
}

.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, #0a58ca 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
}

.btn-outline-primary {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

.btn-outline-primary:hover {
    background: var(--primary);
    color: white;
}

/* ================================
   STAT CARDS
   ================================ */
.stats-overview {
    margin-bottom: 3rem;
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
    transform: translateY(-8px);
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
    background: rgba(13, 202, 240, 0.1);
    color: var(--info);
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

.progress-bar-modern.info {
    background: linear-gradient(90deg, var(--info) 0%, #31d2f2 100%);
}

/* ================================
   INFO SECTION
   ================================ */
.info-section {
    margin-bottom: 3rem;
}

.info-card {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.info-card-content {
    padding: 3rem;
    display: flex;
    align-items: center;
    gap: 2rem;
}

.info-icon-wrapper {
    flex-shrink: 0;
}

.info-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
}

.info-details {
    flex: 1;
}

.info-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.info-description {
    color: var(--text-secondary);
    margin-bottom: 2rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

.info-actions {
    display: flex;
    gap: 1rem;
}

/* ================================
   PROCESS FLOW SECTION
   ================================ */
.process-flow-section {
    margin-bottom: 3rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 2rem;
    text-align: center;
}

.process-flow {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2rem;
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
}

.process-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    width: 180px;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.step-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--bg-tertiary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.step-content h4 {
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.step-content p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.process-arrow {
    color: var(--gold);
    font-size: 1.5rem;
}

/* ================================
   QUICK STATS SECTION
   ================================ */
.quick-stats-section {
    margin-bottom: 3rem;
}

.quick-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.quick-stat {
    background: var(--bg-secondary);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
}

.quick-stat:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.quick-stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.quick-stat-content h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.quick-stat-content p {
    color: var(--text-secondary);
    margin: 0.25rem 0 0 0;
    font-size: 0.9rem;
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
    .nilai-seleksi-container {
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

    .info-card-content {
        flex-direction: column;
        text-align: center;
    }

    .info-actions {
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

    .process-flow {
        flex-direction: column;
        gap: 1.5rem;
    }

    .process-arrow {
        transform: rotate(90deg);
    }

    .quick-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-value {
        font-size: 2rem;
    }
}

@media (max-width: 575.98px) {
    .nilai-seleksi-container {
        padding: 1rem 0;
    }

    .page-header-modern {
        padding: 1.25rem;
    }

    .header-actions {
        flex-direction: column;
    }

    .info-card-content {
        padding: 2rem 1.5rem;
    }

    .quick-stats {
        grid-template-columns: 1fr;
    }

    .empty-state {
        padding: 3rem 1rem;
    }
}
</style>
@endsection