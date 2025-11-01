@extends('layouts.admin')

@section('title', 'Backup Data')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-database"></i>
            Backup Data Sistem
        </h1>
        <p class="page-subtitle">Kelola backup database dan file sistem</p>
    </div>

    <!-- Backup Actions -->
    <div class="row">
        <!-- Create Backup Card -->
        <div class="col-md-6 mb-4">
            <div class="card backup-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus-circle text-primary"></i>
                        Buat Backup Baru
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Buat backup lengkap database sistem PPDB. Backup akan menyimpan semua data siswa, jurusan, nilai, dan pengaturan.</p>
                    
                    <form action="{{ route('admin.backup.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="backup_name" class="form-label">Nama Backup (Opsional)</label>
                            <input type="text" class="form-control" id="backup_name" name="backup_name" 
                                   placeholder="Contoh: Backup Sebelum Update">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Tipe Backup:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="backup_type" id="full_backup" value="full" checked>
                                <label class="form-check-label" for="full_backup">
                                    Full Backup (Database + File)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="backup_type" id="db_backup" value="database">
                                <label class="form-check-label" for="db_backup">
                                    Database Only
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-download me-2"></i>
                            Buat Backup Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Backup Info Card -->
        <div class="col-md-6 mb-4">
            <div class="card info-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle text-info"></i>
                        Informasi Backup
                    </h5>
                </div>
                <div class="card-body">
                    <div class="system-info">
                        <div class="info-item d-flex justify-content-between mb-3">
                            <span>Total Backup:</span>
                            <strong>{{ count($backupFiles) }} file</strong>
                        </div>
                        <div class="info-item d-flex justify-content-between mb-3">
                            <span>Ukuran Total:</span>
                            <strong>{{ $totalSize }}</strong>
                        </div>
                        <div class="info-item d-flex justify-content-between mb-3">
                            <span>Backup Terakhir:</span>
                            <strong>{{ $lastBackup ?? 'Belum ada backup' }}</strong>
                        </div>
                        <div class="info-item d-flex justify-content-between">
                            <span>Status Otomatis:</span>
                            <span class="badge bg-warning">Nonaktif</span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="backup-tips">
                        <h6 class="text-muted">Tips Backup:</h6>
                        <ul class="small text-muted">
                            <li>Lakukan backup secara berkala sebelum update sistem</li>
                            <li>Simpan backup di lokasi yang aman</li>
                            <li>Test restore backup secara periodik</li>
                            <li>Backup otomatis dapat diaktifkan di pengaturan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing Backups -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history text-success"></i>
                        Backup yang Tersedia
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($backupFiles) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Ukuran</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($backupFiles as $file)
                                        @php
                                            $filename = basename($file);
                                            $fileSize = Storage::size($file);
                                            $fileDate = Storage::lastModified($file);
                                        @endphp
                                        <tr>
                                            <td>
                                                <i class="fas fa-file-archive text-warning me-2"></i>
                                                {{ $filename }}
                                            </td>
<td>
    @php
        function formatFileSize($bytes) {
            if ($bytes === 0) return '0 Bytes';
            $k = 1024;
            $sizes = ['Bytes', 'KB', 'MB', 'GB'];
            $i = floor(log($bytes) / log($k));
            return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
        }
    @endphp
    {{ formatFileSize($fileSize) }}
</td>                                            <td>{{ date('d M Y H:i', $fileDate) }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.backup.download', $filename) }}" 
                                                       class="btn btn-outline-primary" title="Download">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger" 
                                                            onclick="confirmDelete('{{ $filename }}')" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                
                                                <!-- Delete Form -->
                                                <form id="delete-form-{{ $filename }}" 
                                                      action="{{ route('admin.backup.delete', $filename) }}" 
                                                      method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada backup</h5>
                            <p class="text-muted">Buat backup pertama Anda untuk mengamankan data sistem.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Backup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus backup <strong id="fileName"></strong>?</p>
                <p class="text-danger small">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<style>
.backup-card, .info-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.backup-card:hover, .info-card:hover {
    transform: translateY(-2px);
}

.system-info {
    font-size: 0.95rem;
}

.backup-tips ul {
    padding-left: 1.2rem;
}

.backup-tips li {
    margin-bottom: 0.3rem;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #6c757d;
}
</style>
@endsection

@push('scripts')
<script>
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function confirmDelete(filename) {
    document.getElementById('fileName').textContent = filename;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
    
    document.getElementById('confirmDeleteBtn').onclick = function() {
        document.getElementById('delete-form-' + filename).submit();
    };
}

// Add formatFileSize helper to window for blade
window.formatFileSize = formatFileSize;
</script>
@endpush    