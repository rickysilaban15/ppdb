@extends('layouts.admin')

@section('title', 'Pengaturan Maintenance')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-tools"></i>
            Pengaturan Maintenance Mode
        </h1>
        <p class="page-subtitle">Kelola mode pemeliharaan sistem</p>
    </div>

    <!-- Maintenance Settings -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-cog me-2"></i>Maintenance Mode
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengaturan.maintenance') }}" method="POST">
                @csrf
                
                <!-- Maintenance Mode Toggle -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="maintenance_mode" 
                                   name="maintenance_mode" value="1" 
                                   {{ $maintenanceSettings['maintenance_mode'] === '1' ? 'checked' : '' }}
                                   onchange="toggleMaintenanceFields(this.checked)">
                            <label class="form-check-label h5" for="maintenance_mode">
                                Aktifkan Maintenance Mode
                            </label>
                        </div>
                        <div class="form-text">
                            Saat diaktifkan, sistem akan menampilkan halaman maintenance kepada pengunjung.
                            Admin tetap bisa mengakses sistem.
                        </div>
                    </div>
                </div>
                
                <!-- Maintenance Message -->
                <div class="row mb-3" id="maintenanceFields">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="maintenance_message" class="form-label">
                                <i class="fas fa-comment-dots me-2"></i>Pesan Maintenance
                            </label>
                            <textarea class="form-control" id="maintenance_message" 
                                      name="maintenance_message" rows="4" 
                                      placeholder="Masukkan pesan yang akan ditampilkan kepada pengunjung..."
                                      required>{{ $maintenanceSettings['maintenance_message'] }}</textarea>
                            <div class="form-text">
                                Pesan ini akan ditampilkan di halaman maintenance.
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Maintenance Schedule -->
                <div class="row" id="maintenanceSchedule">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="maintenance_start" class="form-label">
                                <i class="fas fa-play me-2"></i>Mulai Maintenance
                            </label>
                            <input type="datetime-local" class="form-control" id="maintenance_start" 
                                   name="maintenance_start" 
                                   value="{{ $maintenanceSettings['maintenance_start'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="maintenance_end" class="form-label">
                                <i class="fas fa-stop me-2"></i>Estimasi Selesai
                            </label>
                            <input type="datetime-local" class="form-control" id="maintenance_end" 
                                   name="maintenance_end" 
                                   value="{{ $maintenanceSettings['maintenance_end'] }}" required>
                        </div>
                    </div>
                </div>
                
                <!-- Preview & Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" class="btn btn-outline-info" onclick="previewMaintenance()">
                                    <i class="fas fa-eye me-2"></i>Preview Maintenance
                                </button>
                            </div>
                            <div>
                                <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-secondary me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Current Status -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Status Saat Ini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Maintenance Mode:</span>
                        <span class="badge bg-{{ $maintenanceSettings['maintenance_mode'] === '1' ? 'danger' : 'success' }}">
                            {{ $maintenanceSettings['maintenance_mode'] === '1' ? 'AKTIF' : 'NON-AKTIF' }}
                        </span>
                    </div>
                    
                    @if($maintenanceSettings['maintenance_mode'] === '1')
                    <div class="alert alert-warning">
                        <small>
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Sistem sedang dalam mode maintenance. 
                            Pengunjung akan melihat halaman maintenance.
                        </small>
                    </div>
                    @else
                    <div class="alert alert-success">
                        <small>
                            <i class="fas fa-check-circle me-2"></i>
                            Sistem berjalan normal. Pengunjung dapat mengakses semua fitur.
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Tips Maintenance
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Aktifkan maintenance mode saat update sistem
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Beri estimasi waktu yang realistis
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Sertakan kontak untuk keadaan darurat
                        </li>
                        <li>
                            <i class="fas fa-check text-success me-2"></i>
                            Nonaktifkan setelah maintenance selesai
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#maintenanceFields, #maintenanceSchedule {
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background-color: #8B0000;
    border-color: #8B0000;
}
</style>

<script>
function toggleMaintenanceFields(isEnabled) {
    const fields = document.getElementById('maintenanceFields');
    const schedule = document.getElementById('maintenanceSchedule');
    
    if (isEnabled) {
        fields.style.display = 'block';
        schedule.style.display = 'flex';
        // Set required attributes
        document.getElementById('maintenance_message').required = true;
        document.getElementById('maintenance_start').required = true;
        document.getElementById('maintenance_end').required = true;
    } else {
        fields.style.display = 'none';
        schedule.style.display = 'none';
        // Remove required attributes
        document.getElementById('maintenance_message').required = false;
        document.getElementById('maintenance_start').required = false;
        document.getElementById('maintenance_end').required = false;
    }
}

function previewMaintenance() {
    window.open('/preview-maintenance', '_blank');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const isMaintenanceMode = document.getElementById('maintenance_mode').checked;
    toggleMaintenanceFields(isMaintenanceMode);
});
</script>
@endsection