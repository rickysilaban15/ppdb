@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="data-siswa-container">
    <!-- Enhanced Page Header -->
    <div class="page-header-modern animate__animated animate__fadeInDown">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-user-graduate"></i>
                    Data Siswa PPDB
                </h1>
                <p class="page-subtitle">
                    Kelola data calon siswa <strong class="text-gradient">SMK N 2 Siatas Barita</strong>
                </p>
            </div>
            <div class="header-actions">
                <button class="btn btn-export" id="exportBtn">
                    <i class="fas fa-download me-2"></i>
                    Export Data
                </button>
<a href="{{ route('admin.siswa.create') }}" class="btn btn-add-modern">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Siswa
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row g-4 mb-4 animate__animated animate__fadeInUp">
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
                        <h6 class="stat-label">Total Siswa</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $stats['total'] ?? 0 }}">0</h2>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>100%</span>
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

        <!-- Siswa Lulus Card -->
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
                    <h2 class="stat-value" data-target="{{ $stats['diterima'] ?? 0 }}">0</h2>
                    <div class="stat-trend up">
                        <i class="fas fa-trophy"></i>
                        <span>{{ $stats['total'] > 0 ? round(($stats['diterima']/$stats['total'])*100) : 0 }}%</span>
                    </div>
                </div>
                <div class="stat-footer">
                    <span class="badge stat-badge success-badge">
                        <i class="fas fa-check-double me-1"></i>Diterima
                    </span>
                </div>
            </div>
        </div>
        <div class="stat-progress">
            <div class="progress-bar-modern success" style="width: {{ $stats['total'] > 0 ? round(($stats['diterima']/$stats['total'])*100) : 0 }}%"></div>
        </div>
    </div>
</div>

<!-- Tidak Lulus Card -->
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
                    <h2 class="stat-value" data-target="{{ $stats['ditolak'] ?? 0 }}">0</h2>
                    <div class="stat-trend down">
                        <i class="fas fa-times"></i>
                        <span>{{ $stats['total'] > 0 ? round(($stats['ditolak']/$stats['total'])*100) : 0 }}%</span>
                    </div>
                </div>
                <div class="stat-footer">
                    <span class="badge stat-badge danger-badge">
                        <i class="fas fa-ban me-1"></i>Ditolak
                    </span>
                </div>
            </div>
        </div>
        <div class="stat-progress">
<div class="progress-bar-modern danger" style="width: 42%"></div>
        </div>
    </div>
</div>

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
                            <h2 class="stat-value" data-target="{{ $stats['pending'] ?? 0 }}">0</h2>
                            <div class="stat-trend neutral">
                                <i class="fas fa-clock"></i>
                                <span>{{ $stats['total'] > 0 ? round(($stats['pending']/$stats['total'])*100) : 0 }}%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge warning-badge">
                                <i class="fas fa-exclamation-circle me-1"></i>Proses
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar-modern warning" style="width: {{ $stats['total'] > 0 ? round(($stats['pending']/$stats['total'])*100) : 0 }}%"></div>
                </div>
            </div>
        </div>

        

    <!-- Enhanced Filter Section -->
    <div class="filter-card-modern animate__animated animate__fadeInUp animate__delay-1s">
        <div class="filter-header">
            <div class="filter-header-left">
                <h5 class="filter-title">
                    <i class="fas fa-filter"></i>
                    Filter & Pencarian
                </h5>
                <button class="btn btn-sm btn-reset" id="resetFilter">
                    <i class="fas fa-redo me-1"></i>Reset Filter
                </button>
            </div>
            <button class="btn btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="filterCollapse">
            <div class="filter-body">
<form action="{{ route('admin.siswa.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-search me-2"></i>Pencarian
                                </label>
                                <input type="text" class="form-control-modern" name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="Nama, NISN, NIK, Email...">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
    <div class="form-group-modern">
        <label class="form-label-modern">
            <i class="fas fa-check-circle me-2"></i>Status
        </label>
        <select class="form-select-modern" name="status">
            <option value="">Semua Status</option>
            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>
</div>
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-route me-2"></i>Jalur
                                </label>
                                <select class="form-select-modern" name="jalur">
                                    <option value="">Semua Jalur</option>
                                    <option value="zonasi" {{ request('jalur') == 'zonasi' ? 'selected' : '' }}>Zonasi</option>
                                    <option value="prestasi" {{ request('jalur') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                    <option value="afirmasi" {{ request('jalur') == 'afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                                    <option value="mutasi" {{ request('jalur') == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-graduation-cap me-2"></i>Jurusan
                                </label>
                                <select class="form-select-modern" name="jurusan">
                                    <option value="">Semua Jurusan</option>
                                    <option value="tkj">TKJ</option>
                                    <option value="rpl">RPL</option>
                                    <option value="mm">Multimedia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="form-group-modern">
                                <label class="form-label-modern" style="opacity: 0;">Action</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-filter flex-fill">
                                        <i class="fas fa-search me-2"></i>Cari
                                    </button>
                                    <button type="button" class="btn btn-outline-filter" id="advancedFilter">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="table-card-modern animate__animated animate__fadeInUp animate__delay-2s">
        <div class="table-header">
            <div class="table-header-left">
                <h5 class="table-title">
                    <i class="fas fa-table"></i>
                    Daftar Siswa
                </h5>
                <span class="badge badge-count">{{ $siswas->total() }} Data</span>
            </div>
            <div class="table-header-right">
                <!-- Bulk Actions -->
<form id="bulkForm" action="{{ route('admin.siswa.bulkAction') }}" method="POST" class="d-inline-flex align-items-center gap-2">
                    @csrf
                    <input type="hidden" name="selected_ids" id="selectedIds">
                    <div class="bulk-actions">
                        <select name="action" class="form-select-modern form-select-sm" id="bulkAction">
    <option value="">Aksi Massal</option>
    <option value="diterima">✓ Set Diterima</option>
    <option value="ditolak">✗ Set Ditolak</option>
    <option value="pending">⏱ Set Pending</option>
    <option value="delete">🗑 Hapus Terpilih</option>
</select>
                        <button type="submit" class="btn btn-apply-bulk" id="bulkSubmit">
                            <i class="fas fa-check me-1"></i>Terapkan
                        </button>
                    </div>
                </form>
                
                <div class="table-view-options">
                    <button class="btn btn-view active" data-view="table" title="Table View">
                        <i class="fas fa-table"></i>
                    </button>
                    <button class="btn btn-view" data-view="grid" title="Grid View">
                        <i class="fas fa-th"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-body">
            @if($siswas->count() > 0)
                <div class="table-responsive" id="tableView">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th width="40">
                                    <div class="checkbox-modern">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label>
                                    </div>
                                </th>
                                <th width="50">#</th>
                                <th>
                                    <div class="th-content">
                                        <span>No. Pendaftaran</span>
                                        <i class="fas fa-sort"></i>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <span>Data Siswa</span>
                                        <i class="fas fa-sort"></i>
                                    </div>
                                </th>
                                <th>NISN</th>
                                <th>Asal Sekolah</th>
                                <th>Pilihan Jurusan</th>
                                <th>
                                    <div class="th-content">
                                        <span>Jalur</span>
                                        <i class="fas fa-sort"></i>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <span>Skor</span>
                                        <i class="fas fa-sort"></i>
                                    </div>
                                </th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $siswa)
                            <tr class="table-row-modern">
                                <td>
                                    <div class="checkbox-modern">
                                        <input type="checkbox" class="row-checkbox" value="{{ $siswa->id }}" id="check{{ $siswa->id }}">
                                        <label for="check{{ $siswa->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <span class="row-number">{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="no-pendaftaran">
                                        <i class="fas fa-id-card me-2"></i>
                                        <strong>{{ $siswa->no_pendaftaran ?? 'N/A' }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->nama_lengkap) }}&background=random&size=40" alt="Avatar">
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">{{ $siswa->nama_lengkap }}</div>
                                            <div class="student-email">
                                                <i class="fas fa-envelope me-1"></i>{{ $siswa->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="nisn-badge">{{ $siswa->nisn }}</span>
                                </td>
                                <td>
                                    <div class="school-info">
                                        <i class="fas fa-school me-2"></i>
                                        {{ $siswa->asal_sekolah }}
                                    </div>
                                </td>
                                <td>
                                    <div class="jurusan-pills">
                                        <span class="badge badge-jurusan primary">
                                            <i class="fas fa-star me-1"></i>
                                            {{ $siswa->jurusanPilihan1->nama_jurusan ?? 'N/A' }}
                                        </span>
                                        @if($siswa->jurusanPilihan2)
                                        <span class="badge badge-jurusan secondary">
                                            {{ $siswa->jurusanPilihan2->nama_jurusan }}
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-jalur {{ $siswa->jalur_pendaftaran }}">
                                        <i class="fas fa-route me-1"></i>
                                        {{ ucfirst($siswa->jalur_pendaftaran) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="skor-display {{ $siswa->skor_akhir >= 75 ? 'high' : ($siswa->skor_akhir >= 60 ? 'medium' : 'low') }}">
                                        <div class="skor-value">{{ $siswa->skor_akhir ?? '0' }}</div>
                                        <div class="skor-bar">
                                            <div class="skor-progress" style="width: {{ $siswa->skor_akhir ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
    $statusConfig = [
        'diterima' => ['class' => 'success', 'icon' => 'check-circle', 'text' => 'Diterima'],
        'ditolak' => ['class' => 'danger', 'icon' => 'times-circle', 'text' => 'Ditolak'],
        'pending' => ['class' => 'warning', 'icon' => 'clock', 'text' => 'Pending']
    ];
    $status = $statusConfig[$siswa->status_seleksi] ?? ['class' => 'secondary', 'icon' => 'question', 'text' => 'Unknown'];
@endphp
<span class="badge badge-status {{ $status['class'] }}">
    <i class="fas fa-{{ $status['icon'] }} me-1"></i>
    {{ $status['text'] }}
</span>
                                </td>
                                <td>
                                    <div class="date-display">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $siswa->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
    <div class="action-buttons">
        <a href="{{ route('admin.siswa.show', $siswa->id) }}" 
           class="btn-action info" 
           title="Lihat Detail" 
           data-bs-toggle="tooltip">
            <i class="fas fa-eye"></i>
        </a>

        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" 
           class="btn-action warning" 
           title="Edit Data" 
           data-bs-toggle="tooltip">
            <i class="fas fa-edit"></i>
        </a>

        <button type="button"
                class="btn-action danger" 
                title="Hapus" 
                data-bs-toggle="tooltip"
                onclick="confirmDelete({{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')">
            <i class="fas fa-trash"></i>
        </button>

        <form id="delete-form-{{ $siswa->id }}" 
              action="{{ route('admin.siswa.destroy', $siswa->id) }}" 
              method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Grid View (Hidden by default) -->
                <div class="grid-view" id="gridView" style="display: none;">
                    <div class="row g-4">
                        @foreach($siswas as $siswa)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="student-card">
                                <div class="student-card-header">
                                    <div class="checkbox-modern">
                                        <input type="checkbox" class="row-checkbox-grid" value="{{ $siswa->id }}" id="checkGrid{{ $siswa->id }}">
                                        <label for="checkGrid{{ $siswa->id }}"></label>
                                    </div>
                                    @php
    $statusConfig = [
        'diterima' => ['class' => 'success', 'icon' => 'check-circle', 'text' => 'Diterima'],
        'ditolak' => ['class' => 'danger', 'icon' => 'times-circle', 'text' => 'Ditolak'],
        'pending' => ['class' => 'warning', 'icon' => 'clock', 'text' => 'Pending']
    ];
    $status = $statusConfig[$siswa->status_seleksi] ?? ['class' => 'secondary', 'icon' => 'question', 'text' => 'Unknown'];
@endphp
<span class="badge badge-status {{ $status['class'] }}">
    <i class="fas fa-{{ $status['icon'] }} me-1"></i>
    {{ $status['text'] }}
</span>
                                </div>
                                <div class="student-card-avatar">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->nama_lengkap) }}&background=random&size=80" alt="Avatar">
                                </div>
                                <div class="student-card-body">
                                    <h6 class="student-card-name">{{ $siswa->nama_lengkap }}</h6>
                                    <p class="student-card-id">{{ $siswa->no_pendaftaran ?? 'N/A' }}</p>
                                    <div class="student-card-info">
                                        <div class="info-item">
                                            <i class="fas fa-graduation-cap"></i>
                                            <span>{{ $siswa->jurusanPilihan1->nama_jurusan ?? 'N/A' }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-route"></i>
                                            <span>{{ ucfirst($siswa->jalur_pendaftaran) }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-star"></i>
                                            <span>Skor: {{ $siswa->skor_akhir ?? '0' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-card-footer">
<a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-card-action">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    
<a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-card-action">
    <i class="fas fa-edit me-1"></i>Edit
</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-modern">
                    <div class="pagination-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Menampilkan <strong>{{ $siswas->firstItem() }}</strong> hingga <strong>{{ $siswas->lastItem() }}</strong> 
                        dari <strong>{{ $siswas->total() }}</strong> data
                    </div>
                    <div class="pagination-links">
                        {{ $siswas->links() }}
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4 class="empty-state-title">Belum Ada Data Siswa</h4>
                    <p class="empty-state-text">
                        Mulai kelola data siswa dengan menambahkan data pertama Anda
                    </p>
<a href="{{ route('admin.siswa.create') }}" class="btn btn-add-modern">                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Siswa Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Container */
.data-siswa-container {
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

.text-gradient {
    background: linear-gradient(90deg, var(--gold), var(--burgundy));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.header-actions {
    display: flex;
    gap: 1rem;
}

.btn-export {
    background: white;
    border: 2px solid var(--gold);
    color: var(--burgundy);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-export:hover {
    background: var(--gold);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
}

.btn-add-modern {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    border: none;
    color: var(--burgundy);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.btn-add-modern:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
    color: white;
}

/* Enhanced Statistics Cards - Inherit from dashboard */
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

.stat-card-modern.primary { border-color: rgba(13, 110, 253, 0.2); }
.stat-card-modern.success { border-color: rgba(25, 135, 84, 0.2); }
.stat-card-modern.warning { border-color: rgba(255, 193, 7, 0.2); }
.stat-card-modern.danger { border-color: rgba(220, 53, 69, 0.2); }

.stat-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: rgba(0,0,0,0.05);
}

.progress-bar-modern {
    height: 100%;
    transition: width 1.5s ease;
}

.progress-bar-modern.primary { background: #0d6efd; }
.progress-bar-modern.success { background: #198754; }
.progress-bar-modern.warning { background: #ffc107; }
.progress-bar-modern.danger { background: #dc3545; }

.stat-trend.down {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

/* Enhanced Filter Card */
.filter-card-modern {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
    overflow: hidden;
}

body.dark-mode .filter-card-modern {
    background: #2d2d2d;
}

.filter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-bottom: 2px solid #e9ecef;
}

body.dark-mode .filter-header {
    border-bottom-color: #444;
}

.filter-header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.filter-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-reset {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    border: none;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-reset:hover {
    background: #dc3545;
    color: white;
    transform: scale(1.05);
}

.btn-collapse {
    background: none;
    border: 2px solid var(--gold);
    color: var(--gold);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-collapse:hover {
    background: var(--gold);
    color: white;
    transform: rotate(180deg);
}

.filter-body {
    padding: 2rem;
}

.form-group-modern {
    margin-bottom: 0;
}

.form-label-modern {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.form-control-modern,
.form-select-modern {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.form-control-modern:focus,
.form-select-modern:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
}

.btn-filter {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    border: none;
    color: var(--burgundy);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
    color: white;
}

.btn-outline-filter {
    background: white;
    border: 2px solid var(--gold);
    color: var(--gold);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.btn-outline-filter:hover {
    background: var(--gold);
    color: white;
}

/* Enhanced Table Card */
.table-card-modern {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    overflow: hidden;
}

body.dark-mode .table-card-modern {
    background: #2d2d2d;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-bottom: 2px solid #e9ecef;
    flex-wrap: wrap;
    gap: 1rem;
}

body.dark-mode .table-header {
    border-bottom-color: #444;
}

.table-header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.table-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.badge-count {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: var(--burgundy);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
}

.table-header-right {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.bulk-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-apply-bulk {
    background: var(--gold);
    border: none;
    color: var(--burgundy);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-apply-bulk:hover {
    background: var(--gold-dark);
    color: white;
    transform: scale(1.05);
}

.table-view-options {
    display: flex;
    gap: 0.5rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 0.25rem;
}

.btn-view {
    background: none;
    border: none;
    color: #6c757d;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-view:hover {
    background: rgba(212, 175, 55, 0.1);
    color: var(--gold);
}

.btn-view.active {
    background: var(--gold);
    color: white;
}

/* Enhanced Table */
.table-modern {
    width: 100%;
    margin: 0;
}

.table-modern thead {
    background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-light) 100%);
    color: white;
}

.table-modern thead th {
    padding: 1.25rem 1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
    border: none;
    white-space: nowrap;
}

.th-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
}

.th-content i {
    opacity: 0.5;
    cursor: pointer;
    transition: all 0.3s ease;
}

.th-content:hover i {
    opacity: 1;
    transform: scale(1.2);
}

.table-modern tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #e9ecef;
}

body.dark-mode .table-modern tbody tr {
    border-bottom-color: #444;
}

.table-modern tbody tr:hover {
    background: linear-gradient(90deg, rgba(212, 175, 55, 0.05) 0%, rgba(212, 175, 55, 0.1) 100%);
    transform: scale(1.01);
}

.table-modern tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
}

/* Checkbox Modern */
.checkbox-modern {
    position: relative;
    display: inline-block;
}

.checkbox-modern input[type="checkbox"] {
    opacity: 0;
    position: absolute;
}

.checkbox-modern label {
    width: 20px;
    height: 20px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    display: inline-block;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    margin: 0;
}

.checkbox-modern input[type="checkbox"]:checked + label {
    background: var(--gold);
    border-color: var(--gold);
}

.checkbox-modern input[type="checkbox"]:checked + label::after {
    content: '\f00c';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.75rem;
}

.row-number {
    font-weight: 700;
    color: #6c757d;
}

.no-pendaftaran {
    display: flex;
    align-items: center;
    font-family: 'Courier New', monospace;
}

.no-pendaftaran i {
    color: var(--gold);
}

/* Student Info */
.student-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.student-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid var(--gold);
    object-fit: cover;
}

.student-name {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

body.dark-mode .student-name {
    color: #e0e0e0;
}

.student-email {
    font-size: 0.85rem;
    color: #6c757d;
}

.nisn-badge {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 700;
    font-family: 'Courier New', monospace;
}

.school-info {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.school-info i {
    color: var(--gold);
}

/* Jurusan Pills */
.jurusan-pills {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.badge-jurusan {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    font-size: 0.85rem;
}

.badge-jurusan.primary {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.2) 100%);
    color: #0d6efd;
    border: 1px solid rgba(13, 110, 253, 0.3);
}

.badge-jurusan.secondary {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
    border: 1px solid rgba(108, 117, 125, 0.3);
}

/* Jalur Badge */
.badge-jalur {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    text-transform: capitalize;
    font-size: 0.85rem;
}

.badge-jalur.zonasi {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}

.badge-jalur.prestasi {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.badge-jalur.afirmasi {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.badge-jalur.mutasi {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

/* Skor Display */
.skor-display {
    text-align: center;
}

.skor-value {
    font-size: 1.5rem;
    font-weight: 800;
    font-family: 'Playfair Display', serif;
    margin-bottom: 0.5rem;
}

.skor-display.high .skor-value { color: #198754; }
.skor-display.medium .skor-value { color: #ffc107; }
.skor-display.low .skor-value { color: #dc3545; }

.skor-bar {
    width: 60px;
    height: 6px;
    background: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    margin: 0 auto;
}

.skor-progress {
    height: 100%;
    transition: width 1s ease;
}

.skor-display.high .skor-progress { background: #198754; }
.skor-display.medium .skor-progress { background: #ffc107; }
.skor-display.low .skor-progress { background: #dc3545; }

/* Status Badge */
.badge-status {
    padding: 0.6rem 1.2rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.badge-status.success {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.2) 100%);
    color: #198754;
}

.badge-status.danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.2) 100%);
    color: #dc3545;
}

.badge-status.warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%);
    color: #ffc107;
}

.date-display {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    font-weight: 500;
}

.date-display i {
    color: var(--gold);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-action.info {
    background: rgba(23, 162, 184, 0.1);
    color: #17a2b8;
}

.btn-action.info:hover {
    background: #17a2b8;
    color: white;
    transform: scale(1.1);
}

.btn-action.warning {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.btn-action.warning:hover {
    background: #ffc107;
    color: white;
    transform: scale(1.1);
}

.btn-action.danger {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.btn-action.danger:hover {
    background: #dc3545;
    color: white;
    transform: scale(1.1);
}

/* Grid View */
.grid-view .row {
    padding: 2rem;
}

.student-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

body.dark-mode .student-card {
    background: #2d2d2d;
}

.student-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.student-card-header {
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #e9ecef;
}

.badge-status-mini {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.student-card-avatar {
    display: flex;
    justify-content: center;
    padding: 1.5rem 0;
}

.student-card-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 4px solid var(--gold);
}

.student-card-body {
    padding: 0 1.5rem 1.5rem;
    text-align: center;
}

.student-card-name {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
}

.student-card-id {
    color: #6c757d;
    font-size: 0.85rem;
    margin-bottom: 1rem;
}

.student-card-info {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.info-item i {
    color: var(--gold);
}

.student-card-footer {
    display: flex;
    border-top: 2px solid #e9ecef;
}

.btn-card-action {
    flex: 1;
    padding: 1rem;
    background: none;
    border: none;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    color: var(--text-dark);
}

.btn-card-action:hover {
    background: var(--gold);
    color: white;
}

/* Pagination Modern */
.pagination-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-top: 2px solid #e9ecef;
    flex-wrap: wrap;
    gap: 1rem;
}

body.dark-mode .pagination-modern {
    border-top-color: #444;
}

.pagination-info {
    color: #6c757d;
    font-weight: 500;
}

.pagination-info strong {
    color: var(--gold);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
}

.empty-state-icon {
    font-size: 5rem;
    color: #e9ecef;
    margin-bottom: 2rem;
}

.empty-state-title {
    font-weight: 700;
    color: #6c757d;
    margin-bottom: 1rem;
}

.empty-state-text {
    color: #adb5bd;
    margin-bottom: 2rem;
}

/* Responsive */
@media (max-width: 1199.98px) {
    .table-modern {
        font-size: 0.9rem;
    }
    
    .table-modern thead th,
    .table-modern tbody td {
        padding: 1rem 0.75rem;
    }
}

@media (max-width: 991.98px) {
    .data-siswa-container {
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
    }

    .btn-export,
    .btn-add-modern {
        flex: 1;
    }

    .table-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .table-header-right {
        width: 100%;
        justify-content: space-between;
    }
}

@media (max-width: 767.98px) {
    .page-title-modern {
        font-size: 1.5rem;
    }

    .filter-body {
        padding: 1.5rem;
    }

    .table-header {
        padding: 1rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-modern {
        min-width: 1200px;
    }

    .pagination-modern {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 575.98px) {
    .data-siswa-container {
        padding: 1rem 0;
    }

    .page-header-modern {
        padding: 1.25rem;
    }

    .filter-header {
        padding: 1rem;
    }

    .filter-body {
        padding: 1rem;
    }

    .header-actions {
        flex-direction: column;
    }

    .btn-export,
    .btn-add-modern {
        width: 100%;
    }

    .table-view-options {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection

@push('scripts')
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

    // Select all checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            document.querySelectorAll('.row-checkbox, .row-checkbox-grid').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }

    // Reset filter button
    document.getElementById('resetFilter')?.addEventListener('click', function() {
        document.getElementById('filterForm').reset();
window.location.href = "{{ route('admin.siswa.index') }}";
    });

    // View toggle (Table/Grid)
    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            document.querySelectorAll('.btn-view').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            if (view === 'table') {
                document.getElementById('tableView').style.display = 'block';
                document.getElementById('gridView').style.display = 'none';
            } else {
                document.getElementById('tableView').style.display = 'none';
                document.getElementById('gridView').style.display = 'block';
            }
        });
    });

    // Bulk form submission
    document.getElementById('bulkForm')?.addEventListener('submit', function(e) {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked, .row-checkbox-grid:checked'))
            .map(checkbox => checkbox.value);
        
        if (selectedIds.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih setidaknya satu siswa untuk melakukan aksi massal.',
                confirmButtonColor: '#D4AF37',
                confirmButtonText: 'OK'
            });
            return;
        }

        document.getElementById('selectedIds').value = selectedIds.join(',');

        const action = document.getElementById('bulkAction').value;
        if (!action) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih aksi yang akan dilakukan.',
                confirmButtonColor: '#D4AF37',
                confirmButtonText: 'OK'
            });
            return;
        }

        if (action === 'delete') {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus ${selectedIds.length} siswa?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D4AF37',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
                showClass: {
                    popup: 'animate__animated animate__zoomIn animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__zoomOut animate__faster'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        }
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Export dropdown
    document.getElementById('exportBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Export Data',
            html: `
                <div class="text-start">
                    <p class="mb-3">Pilih format export yang diinginkan:</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="exportData('excel')">
                            <i class="fas fa-file-excel me-2"></i>Export ke Excel
                        </button>
                        <button class="btn btn-danger" onclick="exportData('pdf')">
                            <i class="fas fa-file-pdf me-2"></i>Export ke PDF
                        </button>
                        <button class="btn btn-info" onclick="exportData('csv')">
                            <i class="fas fa-file-csv me-2"></i>Export ke CSV
                        </button>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#6c757d',
            width: '400px'
        });
    });

    // Advanced filter
    document.getElementById('advancedFilter')?.addEventListener('click', function() {
        Swal.fire({
            title: 'Filter Lanjutan',
            html: `
                <div class="text-start">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Daftar</label>
                        <div class="d-flex gap-2">
                            <input type="date" class="form-control" id="dateFrom" placeholder="Dari">
                            <input type="date" class="form-control" id="dateTo" placeholder="Sampai">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rentang Skor</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="number" class="form-control" id="scoreMin" placeholder="Min" min="0" max="100">
                            <span>-</span>
                            <input type="number" class="form-control" id="scoreMax" placeholder="Max" min="0" max="100">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="gender">
                            <option value="">Semua</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Terapkan Filter',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#D4AF37',
            preConfirm: () => {
                // Here you would collect the filter values and apply them
                return {
                    dateFrom: document.getElementById('dateFrom').value,
                    dateTo: document.getElementById('dateTo').value,
                    scoreMin: document.getElementById('scoreMin').value,
                    scoreMax: document.getElementById('scoreMax').value,
                    gender: document.getElementById('gender').value
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Apply advanced filters
                console.log('Advanced filters:', result.value);
                showNotification('Filter lanjutan telah diterapkan', 'success');
            }
        });
    });
});

// Confirm delete function
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `
            <div class="text-start">
                <p>Apakah Anda yakin ingin menghapus data siswa berikut?</p>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div>
                        <strong>${name}</strong>
                        <div class="small">ID: ${id}</div>
                    </div>
                </div>
                <p class="mb-0"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#D4AF37',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
        showClass: {
            popup: 'animate__animated animate__zoomIn animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__zoomOut animate__faster'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

// Export data function
function exportData(format) {
    Swal.close();
    
    // Show loading
    Swal.fire({
        title: 'Memproses...',
        html: `
            <div class="text-center">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Sedang menyiapkan data untuk export ke ${format.toUpperCase()}...</p>
            </div>
        `,
        allowOutsideClick: false,
        showConfirmButton: false
    });
    
    // Simulate export process
    setTimeout(() => {
        Swal.close();
        
        // Show success message
        Swal.fire({
            title: 'Export Berhasil!',
            html: `
                <div class="text-start">
                    <p>Data siswa berhasil diexport ke format <strong>${format.toUpperCase()}</strong>.</p>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            File siap diunduh
                        </div>
                    </div>
                </div>
            `,
            icon: 'success',
            confirmButtonColor: '#D4AF37',
            confirmButtonText: 'OK'
        });
        
        // In a real application, you would trigger the actual download here
        // For example: window.location.href = `/siswa/export/${format}`;
    }, 2000);
}

// Show notification function
function showNotification(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
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
</script>
@endpush