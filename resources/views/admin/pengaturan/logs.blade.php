@extends('layouts.admin')

@section('title', 'System Logs')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-history"></i>
            System Logs
        </h1>
        <p class="page-subtitle">Log aktivitas dan error sistem</p>
    </div>

    <!-- Log Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Log Files</h5>
                            <p class="text-muted mb-0">Monitor aktivitas dan error sistem</p>
                        </div>
                        <div class="btn-group">
                            <form action="{{ route('admin.pengaturan.clearLogs') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning" 
                                        onclick="return confirm('Apakah Anda yakin ingin membersihkan semua logs?')">
                                    <i class="fas fa-broom me-2"></i>Bersihkan Logs
                                </button>
                            </form>
                            <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-alt me-2"></i>Laravel Log
                    </h5>
                </div>
                <div class="card-body">
                    @if(!empty($logs) && $logs !== 'Log file tidak ditemukan.' && $logs !== 'Log file kosong.')
                        <div class="log-container">
                            <pre class="log-content"><code>{{ $logs }}</code></pre>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h5 class="text-success">Tidak ada error</h5>
                            <p class="text-muted">Sistem berjalan dengan baik. Tidak ada log error yang tercatat.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Log Information -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Log
                    </h5>
                </div>
                <div class="card-body">
                    <div class="system-info">
                        <div class="info-item d-flex justify-content-between mb-2">
                            <span>File Log:</span>
                            <strong>SMKN2SB.log</strong>
                        </div>
                        <div class="info-item d-flex justify-content-between mb-2">
                            <span>Lokasi:</span>
                            <strong>storage/logs/</strong>
                        </div>
                        <div class="info-item d-flex justify-content-between mb-2">
                            <span>Ukuran File:</span>
                            <strong>
                                @if(file_exists(storage_path('logs/laravel.log')))
                                    {{ number_format(filesize(storage_path('logs/laravel.log')) / 1024, 2) }} KB
                                @else
                                    0 KB
                                @endif
                            </strong>
                        </div>
                        <div class="info-item d-flex justify-content-between">
                            <span>Terakhir Diubah:</span>
                            <strong>
                                @if(file_exists(storage_path('logs/laravel.log')))
                                    {{ date('d M Y H:i:s', filemtime(storage_path('logs/laravel.log'))) }}
                                @else
                                    -
                                @endif
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Tips Log
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Log bersih menandakan sistem berjalan normal</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            <small>Periksa log secara berkala untuk monitoring</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-trash text-danger me-2"></i>
                            <small>Bersihkan log jika ukuran file terlalu besar</small>
                        </li>
                        <li>
                            <i class="fas fa-download text-info me-2"></i>
                            <small>Backup log penting sebelum dibersihkan</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.log-container {
    background: #1a1a1a;
    border-radius: 8px;
    padding: 1rem;
    max-height: 600px;
    overflow-y: auto;
    font-family: 'Courier New', monospace;
}

.log-content {
    color: #00ff00;
    margin: 0;
    font-size: 0.85rem;
    line-height: 1.4;
}

.log-content code {
    background: transparent;
    color: inherit;
    padding: 0;
}

.system-info {
    font-size: 0.9rem;
}

.info-item {
    padding: 0.25rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item:last-child {
    border-bottom: none;
}

/* Scrollbar styling */
.log-container::-webkit-scrollbar {
    width: 8px;
}

.log-container::-webkit-scrollbar-track {
    background: #2a2a2a;
    border-radius: 4px;
}

.log-container::-webkit-scrollbar-thumb {
    background: #555;
    border-radius: 4px;
}

.log-container::-webkit-scrollbar-thumb:hover {
    background: #777;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-scroll to bottom of log container
    const logContainer = document.querySelector('.log-container');
    if (logContainer) {
        logContainer.scrollTop = logContainer.scrollHeight;
    }

    // Add syntax highlighting for common log patterns
    const logContent = document.querySelector('.log-content');
    if (logContent) {
        let content = logContent.innerHTML;
        
        // Highlight error levels
        content = content.replace(/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/g, '<span style="color: #ffa500;">[$1]</span>');
        content = content.replace(/\.ERROR/g, '<span style="color: #ff4444; font-weight: bold;">.ERROR</span>');
        content = content.replace(/\.WARNING/g, '<span style="color: #ffaa00; font-weight: bold;">.WARNING</span>');
        content = content.replace(/\.INFO/g, '<span style="color: #44ff44; font-weight: bold;">.INFO</span>');
        content = content.replace(/\.DEBUG/g, '<span style="color: #8888ff; font-weight: bold;">.DEBUG</span>');
        
        // Highlight stack traces
        content = content.replace(/Stack trace:/g, '<span style="color: #ff4444; font-weight: bold;">Stack trace:</span>');
        content = content.replace(/#\d+/g, '<span style="color: #ffaa00;">$&</span>');
        
        logContent.innerHTML = content;
    }
});
</script>
@endsection