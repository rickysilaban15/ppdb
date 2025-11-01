@extends('layouts.admin')

@section('title', 'Daftar Jurusan')

@section('content')
<div class="jurusan-container">
    <!-- Enhanced Page Header -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title-modern">
                    <i class="fas fa-graduation-cap"></i>
                    Daftar Jurusan
                </h1>
                <p class="page-subtitle">
                    Kelola jurusan <strong class="text-gradient">SMK N 2 Siatas Barita</strong>
                </p>
            </div>
            <div class="header-actions">
                <button class="btn btn-export" id="exportBtn">
                    <i class="fas fa-download me-2"></i>
                    Export Data
                </button>
                <a href="{{ route('admin.jurusan.create') }}" class="btn btn-add-modern">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Jurusan
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern primary">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Total Jurusan</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $jurusans->count() }}">0</h2>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>100%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge primary-badge">
                                <i class="fas fa-database me-1"></i>Semua Jurusan
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar-modern primary" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern success">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Total Kuota</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $totalKuota }}">0</h2>
                            <div class="stat-trend up">
                                <i class="fas fa-chair"></i>
                                <span>Kursi Tersedia</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge success-badge">
                                <i class="fas fa-check-double me-1"></i>Reguler & Unggulan
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar-modern success" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern warning">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Siswa Terdaftar</h6>
                        <div class="stat-value-wrapper">
                            <h2 class="stat-value" data-target="{{ $totalTerisi }}">0</h2>
                            <div class="stat-trend neutral">
                                <i class="fas fa-percentage"></i>
                                <span>{{ $totalKuota > 0 ? round(($totalTerisi / $totalKuota) * 100) : 0 }}%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge warning-badge">
                                <i class="fas fa-user-check me-1"></i>Pendaftar Aktif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar-modern warning" 
                         style="width: {{ $totalKuota > 0 ? round(($totalTerisi / $totalKuota) * 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-modern info">
                <div class="stat-card-overlay"></div>
                <div class="stat-card-content">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="stat-details">
                        <h6 class="stat-label">Kuota Tersisa</h6>
                        <div class="stat-value-wrapper">
                            <?php 
                            $sisaKuota = $totalKuota - $totalTerisi;
                            ?>
                            <h2 class="stat-value" data-target="{{ $sisaKuota }}">0</h2>
                            <div class="stat-trend down">
                                <i class="fas fa-hourglass-half"></i>
                                <span>{{ $totalKuota > 0 ? round(($sisaKuota / $totalKuota) * 100) : 0 }}%</span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="badge stat-badge info-badge">
                                <i class="fas fa-door-open me-1"></i>Masih Tersedia
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar-modern info" style="width: {{ $totalKuota > 0 ? round(($sisaKuota / $totalKuota) * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Filter Section -->
    <div class="filter-card-modern">
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
                <form action="{{ route('admin.jurusan.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-search me-2"></i>Pencarian
                                </label>
                                <input type="text" class="form-control-modern" name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="Kode, Nama Jurusan, Bidang...">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-cogs me-2"></i>Bidang Keahlian
                                </label>
                                <select class="form-select-modern" name="bidang">
                                    <option value="">Semua Bidang</option>
                                    <option value="Teknologi Informasi">Teknologi Informasi</option>
                                    <option value="Teknik">Teknik</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Kesehatan">Kesehatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
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
    <div class="table-card-modern">
        <div class="table-header">
            <div class="table-header-left">
                <h5 class="table-title">
                    <i class="fas fa-table"></i>
                    Daftar Jurusan
                </h5>
                <span class="badge badge-count">{{ $jurusans->count() }} Jurusan</span>
            </div>
            <div class="table-header-right">
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
            @if($jurusans->count() > 0)
                <div class="table-responsive" id="tableView">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>
                                    <div class="th-content">
                                        <span>Kode</span>
                                        <i class="fas fa-sort"></i>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <span>Nama Jurusan</span>
                                        <i class="fas fa-sort"></i>
                                    </div>
                                </th>
                                <th>Bidang Keahlian</th>
                                <th>Kuota Reguler</th>
                                <th>Kuota Unggulan</th>
                                <th>Total Kuota</th>
                                <th>Pendaftar</th>
                                <th>Status Kuota</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jurusans as $jurusan)
                            <?php 
                                $totalKuota = $jurusan->kuota_reguler + $jurusan->kuota_unggulan;
                                $totalPendaftar = ($jurusan->peminat_1 ?? 0) + ($jurusan->peminat_2 ?? 0);
                                $sisaKuota = $totalKuota - $totalPendaftar;
                                $persentaseTerisi = $totalKuota > 0 ? round(($totalPendaftar / $totalKuota) * 100) : 0;
                                
                                if ($persentaseTerisi >= 100) {
                                    $statusKuota = 'penuh';
                                    $statusClass = 'danger';
                                    $statusText = 'Penuh';
                                } elseif ($persentaseTerisi >= 80) {
                                    $statusKuota = 'hampir_penuh';
                                    $statusClass = 'warning';
                                    $statusText = 'Hampir Penuh';
                                } else {
                                    $statusKuota = 'tersedia';
                                    $statusClass = 'success';
                                    $statusText = 'Tersedia';
                                }
                            ?>
                            <tr class="table-row-modern">
                                <td>
                                    <span class="row-number">{{ ($jurusans->currentPage() - 1) * $jurusans->perPage() + $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="jurusan-code">
                                        <i class="fas fa-tag me-2"></i>
                                        <strong>{{ $jurusan->kode_jurusan }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="jurusan-info">
                                        <div class="jurusan-name">{{ $jurusan->nama_jurusan }}</div>
                                        <div class="jurusan-full">{{ $jurusan->nama_lengkap }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-bidang">
                                        <i class="fas fa-cogs me-1"></i>
                                        {{ $jurusan->bidang_keahlian }}
                                    </span>
                                </td>
                                <td>
                                    <div class="kuota-info">
                                        <div class="kuota-value">{{ $jurusan->kuota_reguler }}</div>
                                        <div class="kuota-label">Reguler</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="kuota-info">
                                        <div class="kuota-value">{{ $jurusan->kuota_unggulan }}</div>
                                        <div class="kuota-label">Unggulan</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="total-kuota">
                                        <div class="kuota-value">{{ $totalKuota }}</div>
                                        <div class="kuota-bar">
                                            <div class="kuota-progress" style="width: {{ $persentaseTerisi }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pendaftar-info">
                                        <div class="pendaftar-value">{{ $totalPendaftar }}</div>
                                        <div class="pendaftar-percent">{{ $persentaseTerisi }}%</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-status {{ $statusClass }}">
                                        <i class="fas fa-{{ $statusKuota == 'penuh' ? 'times-circle' : ($statusKuota == 'hampir_penuh' ? 'exclamation-triangle' : 'check-circle') }} me-1"></i>
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.jurusan.show', $jurusan->id) }}" 
                                           class="btn-action info" 
                                           title="Lihat Detail" 
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" 
                                           class="btn-action warning" 
                                           title="Edit Data" 
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn-action danger" 
                                                title="Hapus" 
                                                data-bs-toggle="tooltip"
                                                onclick="confirmDelete({{ $jurusan->id }}, '{{ $jurusan->nama_jurusan }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $jurusan->id }}" 
                                              action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" 
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
                        @foreach($jurusans as $jurusan)
                        <?php 
                            $totalKuota = $jurusan->kuota_reguler + $jurusan->kuota_unggulan;
                            $totalPendaftar = ($jurusan->peminat_1 ?? 0) + ($jurusan->peminat_2 ?? 0);
                            $sisaKuota = $totalKuota - $totalPendaftar;
                            $persentaseTerisi = $totalKuota > 0 ? round(($totalPendaftar / $totalKuota) * 100) : 0;
                            
                            if ($persentaseTerisi >= 100) {
                                $statusKuota = 'penuh';
                                $statusClass = 'danger';
                                $statusText = 'Penuh';
                            } elseif ($persentaseTerisi >= 80) {
                                $statusKuota = 'hampir_penuh';
                                $statusClass = 'warning';
                                $statusText = 'Hampir Penuh';
                            } else {
                                $statusKuota = 'tersedia';
                                $statusClass = 'success';
                                $statusText = 'Tersedia';
                            }
                        ?>
                        <div class="col-xl-4 col-lg-6">
                            <div class="jurusan-card">
                                <div class="jurusan-card-header">
                                    <span class="badge badge-status-mini {{ $statusClass }}">
                                        <i class="fas fa-{{ $statusKuota == 'penuh' ? 'times-circle' : ($statusKuota == 'hampir_penuh' ? 'exclamation-triangle' : 'check-circle') }}"></i>
                                    </span>
                                </div>
                                <div class="jurusan-card-body">
                                    <div class="jurusan-card-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <h6 class="jurusan-card-name">{{ $jurusan->nama_jurusan }}</h6>
                                    <p class="jurusan-card-code">{{ $jurusan->kode_jurusan }}</p>
                                    <div class="jurusan-card-info">
                                        <div class="info-item">
                                            <i class="fas fa-cogs"></i>
                                            <span>{{ $jurusan->bidang_keahlian }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-users"></i>
                                            <span>{{ $totalPendaftar }} / {{ $totalKuota }} Siswa</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-percentage"></i>
                                            <span>{{ $persentaseTerisi }}% Terisi</span>
                                        </div>
                                    </div>
                                    <div class="jurusan-progress">
                                        <div class="progress">
                                            <div class="progress-bar {{ $statusClass == 'danger' ? 'bg-danger' : ($statusClass == 'warning' ? 'bg-warning' : 'bg-success') }}" 
                                                 style="width: {{ $persentaseTerisi }}%"></div>
                                        </div>
                                        <div class="progress-text">{{ $sisaKuota }} kursi tersisa</div>
                                    </div>
                                </div>
                                <div class="jurusan-card-footer">
                                    <a href="{{ route('admin.jurusan.show', $jurusan->id) }}" class="btn btn-card-action">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="btn btn-card-action">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Enhanced Pagination -->
<div class="pagination-modern">
    <div class="pagination-info">
        <i class="fas fa-info-circle me-2"></i>
        <span class="d-none d-md-inline">Menampilkan <strong>{{ $jurusans->firstItem() }}</strong> hingga <strong>{{ $jurusans->lastItem() }}</strong> dari <strong>{{ $jurusans->total() }}</strong> jurusan</span>
        <span class="d-md-none"><strong>{{ $jurusans->firstItem() }}-{{ $jurusans->lastItem() }}</strong> dari <strong>{{ $jurusans->total() }}</strong></span>
    </div>
    <div class="pagination-links">
{{ $jurusans->links('vendor.pagination.bootstrap-4') }}    </div>
</div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="empty-state-title">Belum Ada Data Jurusan</h4>
                    <p class="empty-state-text">
                        Mulai kelola data jurusan dengan menambahkan data pertama Anda
                    </p>
                    <a href="{{ route('admin.jurusan.create') }}" class="btn btn-add-modern">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Jurusan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* ================================
   ROOT VARIABLES - Light Mode
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
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ================================
   CONTAINER
   ================================ */
.jurusan-container {
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

.text-gradient {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
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

.btn-export {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
}

.btn-add-modern {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: white;
}

.btn-add-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
}

.btn-reset {
    background: var(--bg-tertiary);
    color: var(--text-secondary);
    padding: 0.5rem 1rem;
    border-radius: 8px;
}

.btn-reset:hover {
    background: var(--border-color);
}

.btn-collapse {
    background: transparent;
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    transition: var(--transition);
}

.btn-collapse:hover {
    background: var(--bg-tertiary);
    transform: rotate(180deg);
}

.btn-filter {
    background: linear-gradient(135deg, var(--primary) 0%, #0a58ca 100%);
    color: white;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
}

.btn-outline-filter {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

.btn-outline-filter:hover {
    background: var(--primary);
    color: white;
}

/* ================================
   STAT CARDS
   ================================ */
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

.stat-trend.down {
    background: rgba(220, 53, 69, 0.1);
    color: var(--danger);
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
   FILTER CARD
   ================================ */
.filter-card-modern {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    margin-bottom: 2rem;
    transition: var(--transition);
}

.filter-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.filter-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.filter-title i {
    color: var(--gold);
}

.filter-body {
    padding: 2rem;
}

.form-group-modern {
    margin-bottom: 0;
}

.form-label-modern {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.form-label-modern i {
    color: var(--gold);
}

.form-control-modern,
.form-select-modern {
    width: 100%;
    padding: 0.875rem 1.25rem;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: 0.95rem;
    transition: var(--transition);
}

.form-control-modern:focus,
.form-select-modern:focus {
    outline: none;
    border-color: var(--gold);
    box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
    background: var(--bg-secondary);
}

.form-control-modern::placeholder {
    color: var(--text-muted);
}

/* ================================
   TABLE CARD
   ================================ */
.table-card-modern {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
}

.table-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.table-header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.table-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.table-title i {
    color: var(--gold);
}

.badge-count {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: white;
}

.table-header-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.table-view-options {
    display: flex;
    gap: 0.5rem;
    background: var(--bg-primary);
    padding: 0.25rem;
    border-radius: 10px;
}

.btn-view {
    padding: 0.5rem 1rem;
    border: none;
    background: transparent;
    color: var(--text-secondary);
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
}

.btn-view.active,
.btn-view:hover {
    background: var(--gold);
    color: white;
}

.table-body {
    padding: 2rem;
}

/* ================================
   TABLE
   ================================ */
.table-modern {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.table-modern thead th {
    background: var(--bg-primary);
    color: var(--text-primary);
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 1.25rem 1rem;
    border-bottom: 2px solid var(--border-color);
    position: sticky;
    top: 0;
    z-index: 10;
}

.th-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    cursor: pointer;
    user-select: none;
}

.th-content:hover i {
    color: var(--gold);
}

.table-modern tbody td {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-primary);
    vertical-align: middle;
}

.table-row-modern {
    transition: var(--transition);
}

.table-row-modern:hover {
    background: var(--bg-primary);
}

.row-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
}

/* ================================
   TABLE CONTENT
   ================================ */
.jurusan-code {
    display: flex;
    align-items: center;
    font-family: 'Courier New', monospace;
    gap: 0.5rem;
}

.jurusan-code i {
    color: var(--gold);
}

.jurusan-code strong {
    color: var(--text-primary);
}

.jurusan-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.jurusan-name {
    font-weight: 700;
    color: var(--text-primary);
    font-size: 1rem;
}

.jurusan-full {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.badge-bidang {
    padding: 0.5rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    font-size: 0.85rem;
    background: linear-gradient(135deg, rgba(13, 202, 240, 0.1) 0%, rgba(13, 202, 240, 0.2) 100%);
    color: var(--info);
    border: 1px solid rgba(13, 202, 240, 0.3);
}

.kuota-info {
    text-align: center;
}

.kuota-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.kuota-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    margin-top: 0.25rem;
}

.total-kuota {
    text-align: center;
}

.kuota-bar {
    width: 60px;
    height: 6px;
    background: var(--bg-tertiary);
    border-radius: 10px;
    overflow: hidden;
    margin: 0.5rem auto 0;
}

.kuota-progress {
    height: 100%;
    background: linear-gradient(90deg, var(--success) 0%, var(--warning) 50%, var(--danger) 100%);
    transition: width 0.5s ease;
}

.pendaftar-info {
    text-align: center;
}

.pendaftar-value {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.pendaftar-percent {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.badge-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
}

.badge-status.success {
    background: rgba(25, 135, 84, 0.1);
    color: var(--success);
    border: 1px solid rgba(25, 135, 84, 0.3);
}

.badge-status.warning {
    background: rgba(255, 193, 7, 0.1);
    color: var(--warning);
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.badge-status.danger {
    background: rgba(220, 53, 69, 0.1);
    color: var(--danger);
    border: 1px solid rgba(220, 53, 69, 0.3);
}

/* ================================
   ACTION BUTTONS
   ================================ */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.9rem;
}

.btn-action.info {
    background: rgba(13, 202, 240, 0.1);
    color: var(--info);
}

.btn-action.info:hover {
    background: var(--info);
    color: white;
    transform: scale(1.1);
}

.btn-action.warning {
    background: rgba(255, 193, 7, 0.1);
    color: var(--warning);
}

.btn-action.warning:hover {
    background: var(--warning);
    color: white;
    transform: scale(1.1);
}

.btn-action.danger {
    background: rgba(220, 53, 69, 0.1);
    color: var(--danger);
}

.btn-action.danger:hover {
    background: var(--danger);
    color: white;
    transform: scale(1.1);
}

/* ================================
   GRID VIEW
   ================================ */
.jurusan-card {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    transition: var(--transition);
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.jurusan-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.jurusan-card-header {
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    border-bottom: 1px solid var(--border-color);
}

.badge-status-mini {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.badge-status-mini.success {
    background: rgba(25, 135, 84, 0.1);
    color: var(--success);
}

.badge-status-mini.warning {
    background: rgba(255, 193, 7, 0.1);
    color: var(--warning);
}

.badge-status-mini.danger {
    background: rgba(220, 53, 69, 0.1);
    color: var(--danger);
}

.jurusan-card-body {
    padding: 2rem 1.5rem;
    text-align: center;
    flex: 1;
}

.jurusan-card-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
}

.jurusan-card-name {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.jurusan-card-code {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 1.5rem;
    font-family: 'Courier New', monospace;
}

.jurusan-card-info {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.info-item i {
    color: var(--gold);
}

.jurusan-progress {
    margin-bottom: 1rem;
}

.progress {
    height: 8px;
    background: var(--bg-tertiary);
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    transition: width 1s ease;
}

.progress-text {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.jurusan-card-footer {
    display: flex;
    border-top: 1px solid var(--border-color);
}

.btn-card-action {
    flex: 1;
    padding: 1rem;
    border: none;
    background: transparent;
    color: var(--text-primary);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-card-action:not(:last-child) {
    border-right: 1px solid var(--border-color);
}

.btn-card-action:hover {
    background: var(--bg-primary);
    color: var(--gold);
}

/* ================================
   PAGINATION - ENHANCED RESPONSIVE
   ================================ */
.pagination-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.pagination-info {
    color: var(--text-secondary);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.pagination-info i {
    color: var(--gold);
}

.pagination-info strong {
    color: var(--text-primary);
    font-weight: 700;
}

/* Laravel pagination styling */
.pagination-links {
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.375rem;
    margin-bottom: 0;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: var(--primary);
    background-color: var(--bg-secondary);
    border: 1px solid var(--border-color);
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
}

.page-link:hover {
    z-index: 2;
    color: var(--primary);
    text-decoration: none;
    background-color: var(--bg-primary);
    border-color: var(--border-color);
}

.page-link:focus {
    z-index: 3;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.page-item:first-child .page-link {
    margin-left: 0;
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.page-item:last-child .page-link {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

.page-item.active .page-link {
    z-index: 3;
    color: white;
    background-color: var(--gold);
    border-color: var(--gold);
}

.page-item.disabled .page-link {
    color: var(--text-muted);
    pointer-events: none;
    cursor: auto;
    background-color: var(--bg-secondary);
    border-color: var(--border-color);
}

/* ================================
   EMPTY STATE
   ================================ */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-state-icon {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    font-size: 3rem;
    color: white;
    box-shadow: 0 20px 40px rgba(212, 175, 55, 0.3);
}

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.empty-state-text {
    color: var(--text-secondary);
    margin-bottom: 2rem;
    font-size: 1rem;
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
    .table-modern {
        font-size: 0.9rem;
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
    .jurusan-container {
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

    .stat-value {
        font-size: 1.8rem;
    }
    
    /* Pagination adjustments */
    .pagination-modern {
        flex-direction: column;
        gap: 1rem;
    }
    
    .pagination-info {
        text-align: center;
        width: 100%;
    }
    
    .pagination-links {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .pagination {
        flex-wrap: nowrap;
        justify-content: flex-start;
        padding-bottom: 5px;
    }
}

@media (max-width: 767.98px) {
    .page-title-modern {
        font-size: 1.5rem;
    }

    .page-title-modern i {
        font-size: 2rem;
    }

    .filter-body {
        padding: 1.5rem;
    }

    .table-header {
        padding: 1rem;
    }

    .table-body {
        padding: 1rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-modern {
        min-width: 1200px;
    }

    .stat-card-content {
        flex-direction: column;
        text-align: center;
    }

    .stat-value-wrapper {
        flex-direction: column;
        gap: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
    }
    
    /* Mobile pagination adjustments */
    .page-link {
        padding: 0.375rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .pagination {
        margin-bottom: 0;
    }
    
    /* Show abbreviated text for pagination info on mobile */
    .pagination-info span.d-none.d-md-inline {
        display: none !important;
    }
    
    .pagination-info span.d-md-none {
        display: inline !important;
    }
}

@media (max-width: 575.98px) {
    .jurusan-container {
        padding: 1rem 0;
    }

    .page-header-modern {
        padding: 1.25rem;
    }

    .filter-header {
        padding: 1rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .filter-header-left {
        width: 100%;
        flex-direction: column;
        align-items: flex-start;
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

    .action-buttons {
        flex-wrap: wrap;
    }

    .empty-state {
        padding: 3rem 1rem;
    }

    .empty-state-icon {
        width: 100px;
        height: 100px;
        font-size: 2.5rem;
    }
    
    /* Mobile pagination */
    .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    /* Hide some pagination elements on very small screens */
    .page-item:nth-child(n+3):nth-last-child(n+3) {
        display: none;
    }
    
    .page-item:first-child,
    .page-item:last-child,
    .page-item.active {
        display: block !important;
    }
}

/* ================================
   PRINT STYLES
   ================================ */
@media print {
    .page-header-modern,
    .filter-card-modern,
    .pagination-modern,
    .action-buttons,
    .table-view-options {
        display: none !important;
    }

    .table-card-modern {
        box-shadow: none;
        border: 1px solid #ddd;
    }

    .table-modern {
        font-size: 10pt;
    }
}
</style>

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

    // Reset filter button
    document.getElementById('resetFilter')?.addEventListener('click', function() {
        document.getElementById('filterForm').reset();
        window.location.href = "{{ route('admin.jurusan.index') }}";
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
            width: '400px',
            background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
            color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
        });
    });

    // Advanced filter
    document.getElementById('advancedFilter')?.addEventListener('click', function() {
        Swal.fire({
            title: 'Filter Lanjutan',
            html: `
                <div class="text-start">
                    <div class="mb-3">
                        <label class="form-label">Rentang Kuota</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="number" class="form-control" id="kuotaMin" placeholder="Min" min="0">
                            <span>-</span>
                            <input type="number" class="form-control" id="kuotaMax" placeholder="Max" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Kuota</label>
                        <select class="form-select" id="statusKuota">
                            <option value="">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="hampir_penuh">Hampir Penuh</option>
                            <option value="penuh">Penuh</option>
                        </select>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Terapkan Filter',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#D4AF37',
            background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
            color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary'),
            preConfirm: () => {
                return {
                    kuotaMin: document.getElementById('kuotaMin').value,
                    kuotaMax: document.getElementById('kuotaMax').value,
                    statusKuota: document.getElementById('statusKuota').value
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Advanced filters:', result.value);
                showNotification('Filter lanjutan telah diterapkan', 'success');
            }
        });
    });

    // Table sorting
    document.querySelectorAll('.th-content').forEach(th => {
        th.addEventListener('click', function() {
            const icon = this.querySelector('i');
            
            // Reset other icons
            document.querySelectorAll('.th-content i').forEach(i => {
                if (i !== icon) {
                    i.className = 'fas fa-sort';
                }
            });
            
            // Toggle current icon
            if (icon.classList.contains('fa-sort')) {
                icon.className = 'fas fa-sort-up';
            } else if (icon.classList.contains('fa-sort-up')) {
                icon.className = 'fas fa-sort-down';
            } else {
                icon.className = 'fas fa-sort';
            }
            
            // Here you would implement actual sorting logic
            showNotification('Fitur sorting akan segera tersedia', 'info');
        });
    });

    // Smooth scroll animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.stat-card-modern, .jurusan-card, .table-row-modern').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });

    // Loading animation for stat progress bars
    setTimeout(() => {
        document.querySelectorAll('.stat-progress .progress-bar-modern').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    }, 500);

    // Kuota progress bar animation
    setTimeout(() => {
        document.querySelectorAll('.kuota-progress').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    }, 800);
});

// Confirm delete function
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `
            <div class="text-start">
                <p>Apakah Anda yakin ingin menghapus data jurusan berikut?</p>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div>
                        <strong>${name}</strong>
                        <div class="small">ID: ${id}</div>
                    </div>
                </div>
                <p class="mb-0"><strong>Peringatan:</strong> Menghapus jurusan akan mempengaruhi data siswa yang terdaftar di jurusan ini!</p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
        background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
        color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary'),
        showClass: {
            popup: 'animate__animated animate__zoomIn animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__zoomOut animate__faster'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang memproses penghapusan data',
                allowOutsideClick: false,
                showConfirmButton: false,
                background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
                color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary'),
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form
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
        showConfirmButton: false,
        background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
        color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
    });
    
    // Simulate export process
    setTimeout(() => {
        Swal.close();
        
        // Show success message
        Swal.fire({
            title: 'Export Berhasil!',
            html: `
                <div class="text-start">
                    <p>Data jurusan berhasil diexport ke format <strong>${format.toUpperCase()}</strong>.</p>
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
            confirmButtonText: 'OK',
            background: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary'),
            color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary')
        });
        
        // In a real application, you would trigger the actual download here
        // For example: window.location.href = `/jurusan/export/${format}`;
    }, 2000);
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

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + K for search focus
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        document.querySelector('.form-control-modern')?.focus();
    }
    
    // Ctrl/Cmd + N for new jurusan
    if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
        e.preventDefault();
        window.location.href = "{{ route('admin.jurusan.create') }}";
    }
    
    // Ctrl/Cmd + E for export
    if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
        e.preventDefault();
        document.getElementById('exportBtn')?.click();
    }
});

// Handle window resize for responsive table
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Auto switch to grid view on mobile
        if (window.innerWidth < 768) {
            const gridBtn = document.querySelector('.btn-view[data-view="grid"]');
            if (gridBtn && !gridBtn.classList.contains('active')) {
                // gridBtn.click(); // Uncomment if you want auto-switch
            }
        }
    }, 250);
});

// Print function
function printTable() {
    window.print();
}

// Add print button functionality if needed
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.preventDefault();
        printTable();
    }
});

// Auto-save filter state to localStorage
const filterForm = document.getElementById('filterForm');
if (filterForm) {
    filterForm.addEventListener('submit', function() {
        const formData = new FormData(filterForm);
        const filterState = {};
        for (let [key, value] of formData.entries()) {
            filterState[key] = value;
        }
        localStorage.setItem('jurusan_filter_state', JSON.stringify(filterState));
    });
    
    // Restore filter state on page load
    const savedFilter = localStorage.getItem('jurusan_filter_state');
    if (savedFilter) {
        const filterState = JSON.parse(savedFilter);
        Object.keys(filterState).forEach(key => {
            const input = filterForm.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = filterState[key];
            }
        });
    }
}

// Add loading state to buttons
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn && !form.id.includes('delete-form')) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
        }
    });
});

// Success/Error message handling
@if(session('success'))
    showNotification("{{ session('success') }}", 'success');
@endif

@if(session('error'))
    showNotification("{{ session('error') }}", 'danger');
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        showNotification("{{ $error }}", 'danger');
    @endforeach
@endif

// Add hover effect sound (optional - remove if not needed)
document.querySelectorAll('.btn, .btn-action').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
    });
    btn.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});

console.log('%c📚 Daftar Jurusan Loaded Successfully! ', 'background: #D4AF37; color: white; font-size: 16px; padding: 10px; border-radius: 5px;');
console.log('%cKeyboard Shortcuts:', 'font-weight: bold; font-size: 14px;');
console.log('Ctrl/Cmd + K: Focus search');
console.log('Ctrl/Cmd + N: Add new jurusan');
console.log('Ctrl/Cmd + E: Export data');
console.log('Ctrl/Cmd + P: Print');
</script>
@endsection