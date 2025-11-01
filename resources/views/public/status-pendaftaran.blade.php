<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - PPDB SMK N 2 Siatas Barita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #D4AF37;
            --secondary: #800020;
            --dark: #2C2C2C;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .status-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            margin: 50px auto;
            padding: 40px;
            max-width: 900px;
        }
        
        .status-header {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 3px solid var(--primary);
            margin-bottom: 30px;
        }
        
        .status-badge {
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .badge-pending {
            background: linear-gradient(135deg, #ffd93d 0%, #ffb93d 100%);
            color: #333;
        }
        
        .badge-lulus {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        
        .badge-tidak-lulus {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }
        
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid var(--primary);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        
        .info-value {
            color: #212529;
        }
        
        .document-status {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .doc-item {
            background: white;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .doc-item.uploaded {
            border-color: #28a745;
            background: rgba(40, 167, 69, 0.05);
        }
        
        .doc-item.missing {
            border-color: #ffc107;
            background: rgba(255, 193, 7, 0.05);
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
            margin: 30px 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary);
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-marker {
            position: absolute;
            left: -26px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--primary);
        }
        
        .timeline-marker.active {
            background: var(--secondary);
            box-shadow: 0 0 0 2px var(--secondary);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="status-container">
            <!-- Header -->
            <div class="status-header">
                <h2 class="mb-3">
                    <i class="fas fa-clipboard-check me-2" style="color: var(--primary);"></i>
                    Status Pendaftaran PPDB
                </h2>
                <h4 class="text-muted">SMK Negeri 2 Siatas Barita</h4>
                <div class="mt-4">
                    <span class="status-badge 
                        @if($siswa->status_seleksi == 'lulus') badge-lulus
                        @elseif($siswa->status_seleksi == 'tidak_lulus') badge-tidak-lulus
                        @else badge-pending
                        @endif">
                        @if($siswa->status_seleksi == 'lulus')
                            <i class="fas fa-check-circle me-2"></i>LULUS SELEKSI
                        @elseif($siswa->status_seleksi == 'tidak_lulus')
                            <i class="fas fa-times-circle me-2"></i>TIDAK LULUS
                        @else
                            <i class="fas fa-clock me-2"></i>DALAM PROSES
                        @endif
                    </span>
                </div>
            </div>

            <!-- Data Pendaftar -->
            <div class="info-card">
                <h5 class="mb-3">
                    <i class="fas fa-user me-2"></i>
                    Data Pendaftar
                </h5>
                <div class="info-row">
                    <span class="info-label">Nomor Pendaftaran:</span>
                    <span class="info-value"><strong>{{ $siswa->no_pendaftaran }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama Lengkap:</span>
                    <span class="info-value">{{ $siswa->nama_lengkap }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">NISN:</span>
                    <span class="info-value">{{ $siswa->nisn }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Asal Sekolah:</span>
                    <span class="info-value">{{ $siswa->asal_sekolah }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jalur Pendaftaran:</span>
                    <span class="info-value">{{ ucfirst($siswa->jalur_pendaftaran) }}</span>
                </div>
            </div>

            <!-- Pilihan Jurusan -->
            <div class="info-card">
                <h5 class="mb-3">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Pilihan Program Keahlian
                </h5>
                <div class="info-row">
                    <span class="info-label">Pilihan 1 (Prioritas):</span>
                    <span class="info-value">
                        <strong>{{ $siswa->jurusan1->kode_jurusan ?? '-' }}</strong> - 
                        {{ $siswa->jurusan1->nama_lengkap ?? '-' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Pilihan 2 (Alternatif):</span>
                    <span class="info-value">
                        <strong>{{ $siswa->jurusan2->kode_jurusan ?? '-' }}</strong> - 
                        {{ $siswa->jurusan2->nama_lengkap ?? '-' }}
                    </span>
                </div>
                @if($siswa->status_seleksi == 'lulus' && $siswa->jurusan_diterima)
                <div class="info-row bg-success bg-opacity-10">
                    <span class="info-label text-success">Diterima di Jurusan:</span>
                    <span class="info-value text-success">
                        <strong>{{ $siswa->jurusanDiterima->kode_jurusan ?? '-' }}</strong> - 
                        {{ $siswa->jurusanDiterima->nama_lengkap ?? '-' }}
                    </span>
                </div>
                @endif
            </div>

            <!-- Nilai -->
            <div class="info-card">
                <h5 class="mb-3">
                    <i class="fas fa-chart-line me-2"></i>
                    Nilai Akademik
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <h6 class="text-muted">Rata-rata Rapor</h6>
                            <h3 class="text-primary mb-0">{{ number_format($siswa->rerata_nilai_rapor, 2) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <h6 class="text-muted">Nilai Akreditasi</h6>
                            <h3 class="text-primary mb-0">{{ number_format($siswa->nilai_akreditasi_sekolah, 2) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <h6 class="text-muted">Skor Akhir</h6>
                            <h3 class="text-success mb-0">{{ number_format($siswa->skor_akhir, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Dokumen -->
            <div class="info-card">
                <h5 class="mb-3">
                    <i class="fas fa-file-alt me-2"></i>
                    Status Dokumen
                </h5>
                <div class="document-status">
                    <div class="doc-item {{ $siswa->file_kk ? 'uploaded' : 'missing' }}">
                        <i class="fas {{ $siswa->file_kk ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }} fa-2x mb-2"></i>
                        <p class="mb-0"><small>Kartu Keluarga</small></p>
                        <small class="text-muted">{{ $siswa->file_kk ? 'Sudah Upload' : 'Belum Upload' }}</small>
                    </div>
                    <div class="doc-item {{ $siswa->file_akta ? 'uploaded' : 'missing' }}">
                        <i class="fas {{ $siswa->file_akta ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }} fa-2x mb-2"></i>
                        <p class="mb-0"><small>Akta Kelahiran</small></p>
                        <small class="text-muted">{{ $siswa->file_akta ? 'Sudah Upload' : 'Belum Upload' }}</small>
                    </div>
                    <div class="doc-item {{ $siswa->file_ijazah ? 'uploaded' : 'missing' }}">
                        <i class="fas {{ $siswa->file_ijazah ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }} fa-2x mb-2"></i>
                        <p class="mb-0"><small>Ijazah</small></p>
                        <small class="text-muted">{{ $siswa->file_ijazah ? 'Sudah Upload' : 'Belum Upload' }}</small>
                    </div>
                    <div class="doc-item {{ $siswa->file_pas_foto ? 'uploaded' : 'missing' }}">
                        <i class="fas {{ $siswa->file_pas_foto ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }} fa-2x mb-2"></i>
                        <p class="mb-0"><small>Pas Foto</small></p>
                        <small class="text-muted">{{ $siswa->file_pas_foto ? 'Sudah Upload' : 'Belum Upload' }}</small>
                    </div>
                </div>
                
                @if(!$siswa->file_kk || !$siswa->file_akta || !$siswa->file_ijazah || !$siswa->file_pas_foto)
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Mohon lengkapi dokumen yang masih kurang melalui dashboard atau hubungi panitia.
                </div>
                @endif
            </div>

            <!-- Timeline Proses -->
            <div class="info-card">
                <h5 class="mb-4">
                    <i class="fas fa-history me-2"></i>
                    Timeline Proses Seleksi
                </h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker active"></div>
                        <strong>Pendaftaran Berhasil</strong>
                        <p class="text-muted mb-0">{{ $siswa->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker {{ $siswa->status_seleksi != 'pending' ? 'active' : '' }}"></div>
                        <strong>Verifikasi Berkas</strong>
                        <p class="text-muted mb-0">
                            {{ $siswa->status_seleksi != 'pending' ? 'Selesai diverifikasi' : 'Menunggu verifikasi' }}
                        </p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker {{ $siswa->status_seleksi == 'lulus' || $siswa->status_seleksi == 'tidak_lulus' ? 'active' : '' }}"></div>
                        <strong>Pengumuman Hasil</strong>
                        <p class="text-muted mb-0">
                            @if($siswa->status_seleksi == 'lulus')
                                Selamat! Anda diterima
                            @elseif($siswa->status_seleksi == 'tidak_lulus')
                                Mohon maaf, belum berhasil kali ini
                            @else
                                Menunggu pengumuman
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informasi -->
            @if($siswa->status_seleksi == 'pending')
            <div class="alert alert-info">
                <h6 class="alert-heading">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Penting
                </h6>
                <ul class="mb-0">
                    <li>Proses seleksi sedang berlangsung</li>
                    <li>Pengumuman hasil seleksi akan diinformasikan melalui website dan nomor telepon terdaftar</li>
                    <li>Pastikan dokumen sudah dilengkapi</li>
                    <li>Simpan nomor pendaftaran dengan baik</li>
                </ul>
            </div>
            @elseif($siswa->status_seleksi == 'lulus')
            <div class="alert alert-success">
                <h6 class="alert-heading">
                    <i class="fas fa-check-circle me-2"></i>
                    Selamat! Anda Diterima
                </h6>
                <p class="mb-2">Langkah selanjutnya:</p>
                <ul class="mb-0">
                    <li>Lakukan daftar ulang sesuai jadwal yang ditentukan</li>
                    <li>Bawa dokumen asli untuk verifikasi</li>
                    <li>Siapkan biaya administrasi sekolah</li>
                    <li>Hubungi panitia untuk informasi lebih lanjut</li>
                </ul>
            </div>
            @else
            <div class="alert alert-danger">
                <h6 class="alert-heading">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi
                </h6>
                <p class="mb-0">Mohon maaf, Anda belum berhasil pada seleksi kali ini. Tetap semangat dan jangan menyerah!</p>
            </div>
            @endif

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between mt-4">
                <a href="/" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                </a>
                <div>
                    <button onclick="window.print()" class="btn btn-outline-primary me-2">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                    @if($siswa->status_seleksi == 'lulus')
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-file-download me-2"></i>Download Bukti Lulus
                    </a>
                    @endif
                </div>
            </div>

            <!-- Contact -->
            <div class="text-center mt-4 pt-4 border-top">
                <p class="text-muted mb-2">Butuh bantuan?</p>
                <div>
                    <a href="tel:+62123456789" class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-phone me-1"></i>Hubungi Kami
                    </a>
                    <a href="https://wa.me/62123456789" class="btn btn-sm btn-outline-success">
                        <i class="fab fa-whatsapp me-1"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Print Styles -->
    <style media="print">
        body {
            background: white !important;
        }
        .status-container {
            box-shadow: none !important;
            margin: 0 !important;
        }
        .btn, .no-print {
            display: none !important;
        }
    </style>
</body>
</html>