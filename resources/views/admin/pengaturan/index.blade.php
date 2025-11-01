@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="pengaturan-container">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-cogs"></i>
                    Pengaturan Sistem
                </h1>
                <p class="page-subtitle">
                    Konfigurasi sistem PPDB
                </p>
            </div>
        </div>
    </div>

    <!-- Pengaturan Umum -->
    <div class="premium-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-sliders-h me-2"></i>Pengaturan Umum
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                @csrf
                <input type="hidden" name="kategori" value="umum">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="nama_sekolah" class="form-label-modern">
                                <i class="fas fa-school me-2"></i>Nama Sekolah
                            </label>
                            <input type="text" class="form-control-modern" id="nama_sekolah" 
                                   name="nama_sekolah" value="{{ $pengaturan['nama_sekolah'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="tahun_ajaran" class="form-label-modern">
                                <i class="fas fa-calendar-alt me-2"></i>Tahun Ajaran
                            </label>
                            <input type="text" class="form-control-modern" id="tahun_ajaran" 
                                   name="tahun_ajaran" value="{{ $pengaturan['tahun_ajaran'] }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="tanggal_mulai" class="form-label-modern">
                                <i class="fas fa-calendar-plus me-2"></i>Tanggal Mulai Pendaftaran
                            </label>
                            <input type="date" class="form-control-modern" id="tanggal_mulai" 
                                   name="tanggal_mulai" value="{{ $pengaturan['tanggal_mulai'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="tanggal_selesai" class="form-label-modern">
                                <i class="fas fa-calendar-times me-2"></i>Tanggal Selesai Pendaftaran
                            </label>
                            <input type="date" class="form-control-modern" id="tanggal_selesai" 
                                   name="tanggal_selesai" value="{{ $pengaturan['tanggal_selesai'] }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="alamat_sekolah" class="form-label-modern">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat Sekolah
                            </label>
                            <textarea class="form-control-modern" id="alamat_sekolah" 
                                      name="alamat_sekolah" rows="2" required>{{ $pengaturan['alamat_sekolah'] }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="telepon_sekolah" class="form-label-modern">
                                <i class="fas fa-phone me-2"></i>Telepon Sekolah
                            </label>
                            <input type="text" class="form-control-modern" id="telepon_sekolah" 
                                   name="telepon_sekolah" value="{{ $pengaturan['telepon_sekolah'] }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="email_sekolah" class="form-label-modern">
                                <i class="fas fa-envelope me-2"></i>Email Sekolah
                            </label>
                            <input type="email" class="form-control-modern" id="email_sekolah" 
                                   name="email_sekolah" value="{{ $pengaturan['email_sekolah'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="status_pendaftaran" class="form-label-modern">
                                <i class="fas fa-toggle-on me-2"></i>Status Pendaftaran
                            </label>
                            <select class="form-select-modern" id="status_pendaftaran" name="status_pendaftaran" required>
                                <option value="buka" {{ $pengaturan['status_pendaftaran'] == 'buka' ? 'selected' : '' }}>Buka</option>
                                <option value="tutup" {{ $pengaturan['status_pendaftaran'] == 'tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-premium">
                        <i class="fas fa-save me-2"></i>Simpan Pengaturan Umum
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pengaturan PPDB -->
    <div class="premium-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-graduation-cap me-2"></i>Pengaturan PPDB
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                @csrf
                <input type="hidden" name="kategori" value="ppdb">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="ppdb_tahun_ajaran" class="form-label-modern">
                                <i class="fas fa-calendar-alt me-2"></i>Tahun Ajaran PPDB
                            </label>
                            <input type="text" class="form-control-modern" id="ppdb_tahun_ajaran" 
                                   name="tahun_ajaran" value="{{ $pengaturan['tahun_ajaran'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="status_pendaftaran_ppdb" class="form-label-modern">
                                <i class="fas fa-toggle-on me-2"></i>Status Pendaftaran
                            </label>
                            <select class="form-select-modern" id="status_pendaftaran_ppdb" name="status_pendaftaran" required>
                                <option value="buka" {{ $pengaturan['status_pendaftaran'] == 'buka' ? 'selected' : '' }}>Buka</option>
                                <option value="tutup" {{ $pengaturan['status_pendaftaran'] == 'tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="tanggal_mulai_ppdb" class="form-label-modern">
                                <i class="fas fa-calendar-plus me-2"></i>Tanggal Buka Pendaftaran
                            </label>
                            <input type="date" class="form-control-modern" id="tanggal_mulai_ppdb" 
                                   name="tanggal_mulai" value="{{ $pengaturan['tanggal_mulai'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="tanggal_selesai_ppdb" class="form-label-modern">
                                <i class="fas fa-calendar-times me-2"></i>Tanggal Tutup Pendaftaran
                            </label>
                            <input type="date" class="form-control-modern" id="tanggal_selesai_ppdb" 
                                   name="tanggal_selesai" value="{{ $pengaturan['tanggal_selesai'] }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-premium">
                        <i class="fas fa-save me-2"></i>Simpan Pengaturan PPDB
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pengaturan Seleksi -->
    <div class="premium-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-clipboard-check me-2"></i>Pengaturan Seleksi
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                @csrf
                <input type="hidden" name="kategori" value="seleksi">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="min_nilai" class="form-label-modern">
                                <i class="fas fa-percentage me-2"></i>Nilai Minimum Kelulusan
                            </label>
                            <input type="number" class="form-control-modern" id="min_nilai" 
                                   name="min_nilai" value="{{ $pengaturan['min_nilai'] }}" min="0" max="100" required>
                            <div class="form-text">Nilai minimum untuk dinyatakan lulus</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="max_mapel_rendah" class="form-label-modern">
                                <i class="fas fa-chart-bar me-2"></i>Maksimal Mapel Rendah
                            </label>
                            <input type="number" class="form-control-modern" id="max_mapel_rendah" 
                                   name="max_mapel_rendah" value="{{ $pengaturan['max_mapel_rendah'] }}" min="0" required>
                            <div class="form-text">Jumlah maksimal mata pelajaran dengan nilai rendah</div>
                        </div>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-premium">
                        <i class="fas fa-save me-2"></i>Simpan Pengaturan Seleksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pengaturan Email -->
    <div class="premium-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-envelope me-2"></i>Pengaturan Email
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                @csrf
                <input type="hidden" name="kategori" value="email">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="smtp_host" class="form-label-modern">
                                <i class="fas fa-server me-2"></i>SMTP Host
                            </label>
                            <input type="text" class="form-control-modern" id="smtp_host" 
                                   name="smtp_host" value="{{ $pengaturan['smtp_host'] }}">
                            <div class="form-text">Contoh: smtp.gmail.com</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="smtp_port" class="form-label-modern">
                                <i class="fas fa-plug me-2"></i>SMTP Port
                            </label>
                            <input type="number" class="form-control-modern" id="smtp_port" 
                                   name="smtp_port" value="{{ $pengaturan['smtp_port'] }}">
                            <div class="form-text">Contoh: 587, 465</div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="smtp_username" class="form-label-modern">
                                <i class="fas fa-user me-2"></i>SMTP Username
                            </label>
                            <input type="text" class="form-control-modern" id="smtp_username" 
                                   name="smtp_username" value="{{ $pengaturan['smtp_username'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="smtp_password" class="form-label-modern">
                                <i class="fas fa-lock me-2"></i>SMTP Password
                            </label>
                            <input type="password" class="form-control-modern" id="smtp_password" 
                                   name="smtp_password" value="{{ $pengaturan['smtp_password'] }}">
                        </div>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-premium">
                        <i class="fas fa-save me-2"></i>Simpan Pengaturan Email
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Ganti bagian Tools Sistem: -->
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="premium-card h-100">
            <div class="card-body text-center">
                <div class="tool-icon mb-3">
                    <i class="fas fa-database"></i>
                </div>
                <h5>Backup Database</h5>
                <p class="text-muted">Backup data sistem</p>
                <!-- PERBAIKAN: Arahkan ke route backup yang benar -->
                <a href="{{ route('admin.backup') }}" class="btn btn-outline-primary">
                    <i class="fas fa-download me-2"></i>Backup Sekarang
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="premium-card h-100">
            <div class="card-body text-center">
                <div class="tool-icon mb-3">
                    <i class="fas fa-broom"></i>
                </div>
                <h5>Optimasi Sistem</h5>
                <p class="text-muted">Bersihkan cache dan optimasi</p>
                <!-- PERBAIKAN: Ganti route ke optimasi yang benar -->
                <form action="{{ route('admin.pengaturan.optimasi') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning">
                        <i class="fas fa-magic me-2"></i>Optimasi
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="premium-card h-100">
            <div class="card-body text-center">
                <div class="tool-icon mb-3">
                    <i class="fas fa-history"></i>
                </div>
                <h5>System Logs</h5>
                <p class="text-muted">Lihat log sistem</p>
                <a href="{{ route('admin.pengaturan.logs') }}" class="btn btn-outline-info">
                    <i class="fas fa-list me-2"></i>Lihat Logs
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
    <div class="col-md-4 mb-4">
        <div class="premium-card h-100">
            <div class="card-body text-center">
                <div class="tool-icon mb-3">
                    <i class="fas fa-tools"></i>
                </div>
                <h5>Maintenance Mode</h5>
                <p class="text-muted">Kelola mode pemeliharaan sistem</p>
                <a href="{{ route('admin.pengaturan.maintenance') }}" class="btn btn-outline-warning">
                    <i class="fas fa-cog me-2"></i>Kelola Maintenance
                </a>
            </div>
        </div>
    </div>
</div>
</div>

<style>
/* ================================
   PENGATURAN CONTAINER
   ================================ */
.pengaturan-container {
    padding: 2rem 0;
}

/* ================================
   PAGE HEADER
   ================================ */
.page-header-modern {
    background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(139, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
}

.page-header-modern::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    transform: translate(50%, -50%);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
}

.header-text h1 {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-text h1 i {
    color: #D4AF37;
    font-size: 2.5rem;
    animation: pulse 2s infinite;
}

.header-text p {
    color: rgba(255, 255, 255, 0.8);
    margin: 0.5rem 0 0;
}

/* ================================
   PREMIUM CARD
   ================================ */
.premium-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
}

.premium-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.card-header {
    background: #f8f9fa;
    padding: 1.5rem;
    border-bottom: 1px solid #e9ecef;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #212529;
    margin: 0;
    display: flex;
    align-items: center;
}

.card-title i {
    color: #8B0000;
}

.card-body {
    padding: 2rem;
}

/* ================================
   FORM GROUPS
   ================================ */
.form-group-modern {
    margin-bottom: 1.5rem;
}

.form-label-modern {
    font-weight: 600;
    color: #212529;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.form-label-modern i {
    color: #8B0000;
    margin-right: 0.5rem;
}

.form-control-modern,
.form-select-modern {
    width: 100%;
    padding: 0.875rem 1.25rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    background: #fff;
    color: #212529;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control-modern:focus,
.form-select-modern:focus {
    outline: none;
    border-color: #8B0000;
    box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.1);
}

.form-text {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 0.5rem;
}

/* ================================
   BUTTONS
   ================================ */
.btn-premium {
    background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-premium:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(139, 0, 0, 0.3);
}

.btn-outline-primary {
    background: transparent;
    border: 2px solid #0d6efd;
    color: #0d6efd;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-outline-primary:hover {
    background: #0d6efd;
    color: white;
}

.btn-outline-warning {
    background: transparent;
    border: 2px solid #ffc107;
    color: #ffc107;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-outline-warning:hover {
    background: #ffc107;
    color: white;
}

.btn-outline-info {
    background: transparent;
    border: 2px solid #17a2b8;
    color: #17a2b8;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-outline-info:hover {
    background: #17a2b8;
    color: white;
}

/* ================================
   TOOL ICONS
   ================================ */
.tool-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto;
    background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(139, 0, 0, 0.2);
}

/* ================================
   ANIMATIONS
   ================================ */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* ================================
   RESPONSIVE DESIGN
   ================================ */
@media (max-width: 991.98px) {
    .pengaturan-container {
        padding: 1.5rem 0;
    }

    .page-header-modern {
        padding: 1.5rem;
    }

    .header-text h1 {
        font-size: 1.5rem;
    }

    .header-text h1 i {
        font-size: 2rem;
    }
}

@media (max-width: 767.98px) {
    .pengaturan-container {
        padding: 1rem 0;
    }

    .page-header-modern {
        padding: 1.25rem;
    }

    .card-body {
        padding: 1.5rem;
    }
}

@media (max-width: 575.98px) {
    .card-header {
        padding: 1rem;
    }

    .card-body {
        padding: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
            
            // The form will submit normally, no need to prevent default
        });
    });
});
</script>
@endsection