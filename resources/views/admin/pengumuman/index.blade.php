@extends('layouts.admin')

@section('title', 'Pengumuman')

@section('content')
<div class="pengumuman-container">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-bullhorn"></i>
                    Pengumuman
                </h1>
                <p class="page-subtitle">
                    Kelola pengumuman PPDB untuk publik
                </p>
            </div>
            <div class="header-actions">
<a href="{{ route('pengumuman.public') }}" class="btn btn-view-public" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>
                    Lihat Halaman Publik
                </a>
            </div>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="status-card {{ $pengumumanAktif?->value == '1' ? 'published' : 'draft' }}">
                <div class="status-card-body">
                    <div class="status-icon">
                        <i class="fas fa-{{ $pengumumanAktif?->value == '1' ? 'check-circle' : 'edit' }}"></i>
                    </div>
                    <div class="status-details">
                        <h5>Status Saat Ini</h5>
                        <h3>{{ $pengumumanAktif?->value == '1' ? 'Published' : 'Draft' }}</h3>
                        <p>{{ $pengumumanAktif?->value == '1' ? 'Pengumuman aktif dan terlihat publik' : 'Masih dalam tahap penulisan' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="status-card info">
                <div class="status-card-body">
                    <div class="status-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="status-details">
                        <h5>Tanggal Pengumuman</h5>
                        <h3>{{ $pengumumanTanggal ? date('d M Y', strtotime($pengumumanTanggal->value)) : date('d M Y') }}</h3>
                        <p>{{ $pengumumanTanggal && $pengumumanTanggal->value < date('Y-m-d') ? 'Pengumuman telah dipublikasikan' : 'Akan dipublikasikan pada tanggal ini' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-12">
            <div class="status-card success">
                <div class="status-card-body">
                    <div class="status-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="status-details">
                        <h5>Status Toggle</h5>
                        <h3>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="statusToggle" 
                                       {{ $pengumumanAktif?->value == '1' ? 'checked' : '' }}
                                       onchange="toggleStatus(this)">
                                <label class="form-check-label" for="statusToggle">
                                    {{ $pengumumanAktif?->value == '1' ? 'Aktif' : 'Non-aktif' }}
                                </label>
                            </div>
                        </h3>
                        <p>Klik toggle untuk mengubah status pengumuman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengumuman Settings -->
    <div class="premium-card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-cog me-2"></i>Pengaturan Pengumuman
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengumuman.update') }}" method="POST" id="pengumumanForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="pengumuman_tanggal" class="form-label-modern">
                                <i class="fas fa-calendar me-2"></i>Tanggal Pengumuman
                            </label>
                            <input type="date" class="form-control-modern" id="pengumuman_tanggal" 
                                   name="pengumuman_tanggal" value="{{ $pengumumanTanggal?->value ?? date('Y-m-d') }}"
                                   required>
                            <div class="form-text">Tanggal ketika pengumuman akan ditampilkan</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="pengumuman_waktu" class="form-label-modern">
                                <i class="fas fa-clock me-2"></i>Waktu Pengumuman
                            </label>
                            <input type="time" class="form-control-modern" id="pengumuman_waktu" 
                                   name="pengumuman_waktu" value="{{ $pengumumanWaktu?->value ?? '00:00' }}"
                                   required>
                            <div class="form-text">Waktu ketika pengumuman akan ditampilkan</div>
                        </div>
                    </div>
                </div>
                <div class="form-group-modern">
                    <label for="pengumuman_judul" class="form-label-modern">
                        <i class="fas fa-heading me-2"></i>Judul Pengumuman
                    </label>
                    <input type="text" class="form-control-modern" id="pengumuman_judul" 
                           name="pengumuman_judul" value="{{ old('pengumuman_judul', $pengumumanJudul?->value ?? 'Pengumuman Hasil Seleksi PPDB SMK N 2 Siatas Barita') }}"
                           placeholder="Masukkan judul pengumuman" required>
                    <div class="form-text">Judul akan ditampilkan di halaman publik</div>
                </div>
                <div class="form-group-modern">
                    <label for="pengumuman_konten" class="form-label-modern">
                        <i class="fas fa-align-left me-2"></i>Isi Pengumuman
                    </label>
                    <textarea class="form-control-modern" id="pengumuman_konten" name="pengumuman_konten" 
                              rows="8" required>{{ old('pengumuman_konten', $pengumumanKonten?->value ?? 'Hasil seleksi PPDB SMK N 2 Siatas Barita Tahun Ajaran ' . date('Y') . '/' . (date('Y')+1) . ' telah diumumkan. Silakan cek status pendaftaran Anda.') }}</textarea>
                    <div class="form-text">Konten pengumuman yang akan dilihat oleh publik</div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <button type="button" class="btn btn-outline-secondary" id="previewBtn">
                            <i class="fas fa-eye me-2"></i>Preview
                        </button>
                        <button type="button" class="btn btn-outline-danger ms-2" id="resetBtn">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-premium">
                            <i class="fas fa-save me-2"></i>Simpan Pengumuman
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Pengumuman -->
    <div class="premium-card mt-4" id="previewCard" style="display: none;">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-eye me-2"></i>Preview Pengumuman
            </h5>
        </div>
        <div class="card-body">
            <div class="announcement-preview">
                <div class="announcement-header">
                    <h3 id="previewTitle" class="text-burgundy">{{ $pengumumanJudul?->value ?? 'Pengumuman Hasil Seleksi PPDB' }}</h3>
                    <p class="lead">SMK N 2 Siatas Barita</p>
                    <div class="announcement-date">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span id="previewDate">{{ $pengumumanTanggal ? date('d F Y', strtotime($pengumumanTanggal->value)) : date('d F Y') }}</span>
                        <i class="fas fa-clock ms-3"></i>
                        <span id="previewTime">{{ $pengumumanWaktu?->value ?? '00:00 WIB' }}</span>
                    </div>
                </div>
                <hr>
                <div class="announcement-content">
                    <p id="previewContent">{{ $pengumumanKonten?->value ?? 'Hasil seleksi PPDB SMK N 2 Siatas Barita Tahun Ajaran ' . date('Y') . '/' . (date('Y')+1) . ' telah diumumkan. Silakan cek status pendaftaran Anda.' }}</p>
                </div>
                <div class="announcement-footer mt-4">
                    <a href="{{ route('pengumuman.public') }}" class="btn btn-premium" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat Halaman Publik
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ================================
   PENGUMUMAN CONTAINER
   ================================ */
.pengumuman-container {
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

.btn-view-public {
    background: #D4AF37;
    color: #8B0000;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-view-public:hover {
    background: #B8941F;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
}

/* ================================
   STATUS CARDS
   ================================ */
.status-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    height: 100%;
    transition: all 0.3s ease;
}

.status-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.status-card.published {
    border-left: 5px solid #28a745;
}

.status-card.draft {
    border-left: 5px solid #ffc107;
}

.status-card.info {
    border-left: 5px solid #17a2b8;
}

.status-card.success {
    border-left: 5px solid #28a745;
}

.status-card-body {
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.status-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.status-card.published .status-icon {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-card.draft .status-icon {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.status-card.info .status-icon {
    background: rgba(23, 162, 184, 0.1);
    color: #17a2b8;
}

.status-card.success .status-icon {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-details h5 {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-details h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #212529;
    margin: 0 0 0.5rem 0;
}

.status-details p {
    font-size: 0.85rem;
    color: #6c757d;
    margin: 0;
}

/* Form switch styling */
.form-switch {
    padding-left: 3em;
}

.form-switch .form-check-input {
    width: 3em;
    margin-left: -3em;
}

.form-switch .form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
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

.form-control-modern {
    width: 100%;
    padding: 0.875rem 1.25rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    background: #fff;
    color: #212529;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control-modern:focus {
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

.btn-outline-secondary {
    background: transparent;
    border: 2px solid #6c757d;
    color: #6c757d;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
}

.btn-outline-danger {
    background: transparent;
    border: 2px solid #dc3545;
    color: #dc3545;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-outline-danger:hover {
    background: #dc3545;
    color: white;
}

/* ================================
   ANNOUNCEMENT PREVIEW
   ================================ */
.announcement-preview {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid #e9ecef;
}

.announcement-header {
    text-align: center;
    margin-bottom: 2rem;
}

.announcement-header h3 {
    color: #8B0000;
    font-weight: 700;
    margin-bottom: 1rem;
}

.announcement-header .lead {
    color: #495057;
    font-weight: 500;
}

.announcement-date {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(139, 0, 0, 0.1);
    color: #8B0000;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-top: 1rem;
}

.announcement-content {
    color: #495057;
    line-height: 1.6;
}

.announcement-footer {
    text-align: center;
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
    .header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .btn-view-public {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 767.98px) {
    .pengumuman-container {
        padding: 1rem 0;
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
    
    .card-body {
        padding: 1.5rem;
    }
    
    .status-card-body {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .d-flex.justify-content-between div {
        width: 100%;
    }
    
    .d-flex.justify-content-between div button {
        width: 100%;
    }
}

@media (max-width: 575.98px) {
    .page-header-modern {
        padding: 1.25rem;
    }
    
    .card-header {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .announcement-preview {
        padding: 1.5rem;
    }
/* ================================
   DARK MODE TOGGLE
   ================================ */
.btn-dark-mode-toggle {
    background: transparent;
    border: 2px solid #6c757d;
    color: #6c757d;
    padding: 0.75rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    margin-right: 1rem;
}

.btn-dark-mode-toggle:hover {
    background: #6c757d;
    color: white;
}

.btn-dark-mode-toggle.active {
    background: #8B0000;
    border-color: #8B0000;
    color: white;
}

/* ================================
   DARK MODE STYLES
   ================================ */
.pengumuman-container.dark-mode {
    background-color: #1a1a1a;
    color: #f8f9fa;
}

.pengumuman-container.dark-mode .page-header-modern {
    background: linear-gradient(135deg, #660000 0%, #8B0000 100%);
    box-shadow: 0 10px 30px rgba(139, 0, 0, 0.4);
}

.pengumuman-container.dark-mode .status-card {
    background-color: #2d2d2d;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.pengumuman-container.dark-mode .status-card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.pengumuman-container.dark-mode .status-details h5 {
    color: #adb5bd;
}

.pengumuman-container.dark-mode .status-details h3 {
    color: #f8f9fa;
}

.pengumuman-container.dark-mode .status-details p {
    color: #adb5bd;
}

.pengumuman-container.dark-mode .premium-card {
    background-color: #2d2d2d;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.pengumuman-container.dark-mode .card-header {
    background-color: #252525;
    border-bottom: 1px solid #3d3d3d;
}

.pengumuman-container.dark-mode .card-title {
    color: #f8f9fa;
}

.pengumuman-container.dark-mode .card-title i {
    color: #cc0000;
}

.pengumuman-container.dark-mode .card-body {
    background-color: #2d2d2d;
}

.pengumuman-container.dark-mode .form-label-modern {
    color: #f8f9fa;
}

.pengumuman-container.dark-mode .form-label-modern i {
    color: #cc0000;
}

.pengumuman-container.dark-mode .form-control-modern {
    background-color: #252525;
    border-color: #3d3d3d;
    color: #f8f9fa;
}

.pengumuman-container.dark-mode .form-control-modern:focus {
    border-color: #cc0000;
    box-shadow: 0 0 0 4px rgba(204, 0, 0, 0.2);
}

.pengumuman-container.dark-mode .form-text {
    color: #adb5bd;
}

.pengumuman-container.dark-mode .btn-view-public {
    background: #D4AF37;
    color: #660000;
}

.pengumuman-container.dark-mode .btn-view-public:hover {
    background: #B8941F;
}

.pengumuman-container.dark-mode .btn-premium {
    background: linear-gradient(135deg, #660000 0%, #8B0000 100%);
}

.pengumuman-container.dark-mode .btn-premium:hover {
    box-shadow: 0 8px 20px rgba(139, 0, 0, 0.4);
}

.pengumuman-container.dark-mode .btn-outline-secondary {
    border-color: #6c757d;
    color: #adb5bd;
}

.pengumuman-container.dark-mode .btn-outline-secondary:hover {
    background: #6c757d;
    color: #f8f9fa;
}

.pengumuman-container.dark-mode .btn-outline-danger {
    border-color: #dc3545;
    color: #f86c6b;
}

.pengumuman-container.dark-mode .btn-outline-danger:hover {
    background: #dc3545;
    color: white;
}

.pengumuman-container.dark-mode .announcement-preview {
    background-color: #252525;
    border-color: #3d3d3d;
}

.pengumuman-container.dark-mode .announcement-header h3 {
    color: #cc0000;
}

.pengumuman-container.dark-mode .announcement-header .lead {
    color: #e9ecef;
}

.pengumuman-container.dark-mode .announcement-date {
    background: rgba(204, 0, 0, 0.15);
    color: #cc0000;
}

.pengumuman-container.dark-mode .announcement-content {
    color: #e9ecef;
}

.pengumuman-container.dark-mode .form-switch .form-check-input {
    background-color: #3d3d3d;
    border-color: #6c757d;
}

.pengumuman-container.dark-mode .form-switch .form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.pengumuman-container.dark-mode .form-check-label {
    color: #f8f9fa;
}
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview functionality
    const previewBtn = document.getElementById('previewBtn');
    const previewCard = document.getElementById('previewCard');
    const previewTitle = document.getElementById('previewTitle');
    const previewDate = document.getElementById('previewDate');
    const previewTime = document.getElementById('previewTime');
    const previewContent = document.getElementById('previewContent');
    
    const judulInput = document.getElementById('pengumuman_judul');
    const tanggalInput = document.getElementById('pengumuman_tanggal');
    const waktuInput = document.getElementById('pengumuman_waktu');
    const kontenInput = document.getElementById('pengumuman_konten');
    
    previewBtn.addEventListener('click', function() {
        // Update preview content
        previewTitle.textContent = judulInput.value || 'Pengumuman Hasil Seleksi PPDB';
        
        const dateValue = tanggalInput.value;
        if (dateValue) {
            const date = new Date(dateValue);
            previewDate.textContent = date.toLocaleDateString('id-ID', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
        }
        
        previewTime.textContent = waktuInput.value + ' WIB';
        previewContent.textContent = kontenInput.value || 'Isi pengumuman akan muncul di sini...';
        
        // Toggle preview card
        if (previewCard.style.display === 'none') {
            previewCard.style.display = 'block';
            previewCard.scrollIntoView({ behavior: 'smooth' });
        } else {
            previewCard.style.display = 'none';
        }
    });
    
    // Reset form
    const resetBtn = document.getElementById('resetBtn');
    const form = document.getElementById('pengumumanForm');
    
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form?')) {
            form.reset();
            previewCard.style.display = 'none';
        }
    });
    
    // Toggle status function
window.toggleStatus = function(checkbox) {
    const status = checkbox.checked ? '1' : '0';
    
    fetch('{{ route("admin.pengumuman.toggle") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            status: checkbox.checked
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the label
            const label = checkbox.nextElementSibling;
            label.textContent = data.status === '1' ? 'Aktif' : 'Non-aktif';
            
            // Update the status card
            const statusCard = checkbox.closest('.status-card');
            if (data.status === '1') {
                statusCard.className = 'status-card published';
                statusCard.querySelector('.status-icon i').className = 'fas fa-check-circle';
                statusCard.querySelector('.status-details h3').textContent = 'Published';
                statusCard.querySelector('.status-details p').textContent = 'Pengumuman aktif dan terlihat publik';
            } else {
                statusCard.className = 'status-card draft';
                statusCard.querySelector('.status-icon i').className = 'fas fa-edit';
                statusCard.querySelector('.status-details h3').textContent = 'Draft';
                statusCard.querySelector('.status-details p').textContent = 'Masih dalam tahap penulisan';
            }
            
            // Show success message
            showToast('Status pengumuman berhasil diperbarui', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat memperbarui status', 'danger');
    });
};
    
    // Toast notification function
    function showToast(message, type = 'success') {
        const bgColors = {
            success: '#28a745',
            danger: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
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
    
    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
        
        // The form will submit normally, no need to prevent default
    });
});
</script>
@endsection