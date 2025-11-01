@extends('layouts.admin')

@section('title', 'Kontak Support')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-headset"></i>
            Kontak Support
        </h1>
        <p class="page-subtitle">Hubungi tim support untuk bantuan teknis</p>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Kontak
                    </h5>
                </div>
                <div class="card-body">
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="fas fa-school"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">SMK N 2 Siatas Barita</h6>
                                <p class="mb-0 text-muted">Jl. Pendidikan No. 123, Siatas Barita</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Telepon</h6>
                                <p class="mb-0 text-muted">(0621) 12345</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Email</h6>
                                <p class="mb-0 text-muted">info@smkn2siatasbarita.sch.id</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Jam Operasional</h6>
                                <p class="mb-0 text-muted">Senin - Jumat: 08:00 - 16:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Team -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>Tim Support
                    </h5>
                </div>
                <div class="card-body">
                    <div class="support-team">
                        <div class="team-member mb-3">
                            <h6 class="mb-1">Administrator Sistem</h6>
                            <p class="text-muted mb-1">Bertanggung jawab atas maintenance sistem</p>
                            <small class="text-primary">admin@smkn2siatasbarita.sch.id</small>
                        </div>

                        <div class="team-member mb-3">
                            <h6 class="mb-1">Technical Support</h6>
                            <p class="text-muted mb-1">Bantuan teknis dan troubleshooting</p>
                            <small class="text-primary">tech@smkn2siatasbarita.sch.id</small>
                        </div>

                        <div class="team-member">
                            <h6 class="mb-1">PPDB Coordinator</h6>
                            <p class="text-muted mb-1">Koordinator proses PPDB</p>
                            <small class="text-primary">ppdb@smkn2siatasbarita.sch.id</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Emergency Contact -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-exclamation-triangle me-2"></i>Kontak Darurat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <h6>Untuk masalah kritis yang membutuhkan penanganan segera:</h6>
                        <ul class="mb-0">
                            <li><strong>System Down</strong> - Sistem tidak dapat diakses sama sekali</li>
                            <li><strong>Data Corruption</strong> - Data penting hilang atau rusak</li>
                            <li><strong>Security Issue</strong> - Masalah keamanan sistem</li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <p class="mb-2">Hubungi: <strong>+62 812-3456-7890</strong></p>
                        <small class="text-muted">24/7 Emergency Hotline</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e7f1ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0c63e4;
}

.contact-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.contact-item:last-child {
    border-bottom: none;
}

.team-member {
    padding: 1rem;
    border-radius: 8px;
    background-color: #f8f9fa;
}

.support-team .team-member:last-child {
    margin-bottom: 0 !important;
}
</style>
@endsection