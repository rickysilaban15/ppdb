@extends('layouts.admin')

@section('title', 'Notifikasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-bell me-2"></i>Notifikasi
                    </h3>
                    <div>
                        <button class="btn btn-sm btn-outline-primary" id="refreshNotifications">
                            <i class="fas fa-sync-alt me-1"></i> Refresh
                        </button>
                        <button class="btn btn-sm btn-warning" id="markAllRead">
                            <i class="fas fa-check-double me-1"></i> Tandai Semua Dibaca
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis</th>
                                        <th>Pesan</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr class="{{ !$notification->read_at ? 'table-warning' : '' }}">
                                            <td>{{ $notification->id }}</td>
                                            <td>
                                                @if($notification->type == 'info')
                                                    <span class="badge bg-info">Info</span>
                                                @elseif($notification->type == 'warning')
                                                    <span class="badge bg-warning">Warning</span>
                                                @elseif($notification->type == 'success')
                                                    <span class="badge bg-success">Success</span>
                                                @elseif($notification->type == 'error')
                                                    <span class="badge bg-danger">Error</span>
                                                @else
                                                    <span class="badge bg-secondary">Other</span>
                                                @endif
                                            </td>
                                            <td>{{ $notification->data['message'] ?? 'Tidak ada pesan' }}</td>
                                            <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($notification->read_at)
                                                    <span class="badge bg-success">Dibaca</span>
                                                @else
                                                    <span class="badge bg-warning">Belum Dibaca</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$notification->read_at)
                                                    <button class="btn btn-sm btn-success mark-read-btn" data-id="{{ $notification->id }}">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-sm btn-danger delete-notification-btn" data-id="{{ $notification->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <h5>Tidak ada notifikasi</h5>
                            <p class="text-muted">Anda tidak memiliki notifikasi saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mark as read functionality
        document.querySelectorAll('.mark-read-btn').forEach(button => {
            button.addEventListener('click', function() {
                const notificationId = this.getAttribute('data-id');
                
                fetch(`/admin/notifications/mark-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI
                        const row = this.closest('tr');
                        row.classList.remove('table-warning');
                        const statusBadge = row.querySelector('td:nth-child(4) .badge');
                        statusBadge.classList.remove('bg-warning');
                        statusBadge.classList.add('bg-success');
                        statusBadge.textContent = 'Dibaca';
                        
                        // Remove button
                        this.remove();
                        
                        // Show success message
                        showNotification('Notifikasi ditandai sebagai dibaca', 'success');
                    } else {
                        showNotification('Gagal menandai notifikasi sebagai dibaca', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan', 'error');
                });
            });
        });
        
        // Mark all as read functionality
        document.getElementById('markAllRead').addEventListener('click', function() {
            fetch('{{ route("notifications.markAllRead") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page
                    window.location.reload();
                } else {
                    showNotification('Gagal menandai semua notifikasi sebagai dibaca', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan', 'error');
            });
        });
        
        // Refresh notifications
        document.getElementById('refreshNotifications').addEventListener('click', function() {
            window.location.reload();
        });
        
        // Delete notification
        document.querySelectorAll('.delete-notification-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
                    const notificationId = this.getAttribute('data-id');
                    
                    fetch(`/admin/notifications/delete/${notificationId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove row from table
                            this.closest('tr').remove();
                            
                            // Check if there are any notifications left
                            const tbody = document.querySelector('tbody');
                            if (tbody.children.length === 0) {
                                tbody.innerHTML = `
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                            <h5>Tidak ada notifikasi</h5>
                                            <p class="text-muted">Anda tidak memiliki notifikasi saat ini.</p>
                                        </td>
                                    </tr>
                                `;
                            }
                            
                            showNotification('Notifikasi berhasil dihapus', 'success');
                        } else {
                            showNotification('Gagal menghapus notifikasi', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Terjadi kesalahan', 'error');
                    });
                }
            });
        });
    });
</script>
@endpush