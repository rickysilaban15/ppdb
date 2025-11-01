@extends('layouts.admin')

@section('title', 'FAQ - Pertanyaan Umum')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-question-circle"></i>
            FAQ - Pertanyaan Umum
        </h1>
        <p class="page-subtitle">Pertanyaan yang sering diajukan tentang sistem PPDB</p>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- FAQ Accordion -->
            <div class="accordion" id="faqAccordion">
                @foreach($faqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faq{{ $index }}">
                            <strong>{{ $faq['question'] }}</strong>
                        </button>
                    </h2>
                    <div id="faq{{ $index }}" 
                         class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! nl2br(e($faq['answer'])) !!}
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- FAQ Tambahan (Static) -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <strong>Bagaimana cara login ke sistem admin?</strong>
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk login ke sistem admin:</p>
                            <ol>
                                <li>Buka halaman <code>/admin/login</code></li>
                                <li>Masukkan username dan password yang telah diberikan</li>
                                <li>Klik tombol "Login"</li>
                            </ol>
                            <p class="text-muted">Jika lupa password, hubungi super administrator.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <strong>Bagaimana cara menambah data siswa manual?</strong>
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk menambah data siswa manual:</p>
                            <ol>
                                <li>Buka menu <strong>Data Siswa</strong></li>
                                <li>Klik tombol <strong>Tambah Siswa</strong></li>
                                <li>Isi form data siswa dengan lengkap</li>
                                <li>Klik <strong>Simpan</strong></li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            <strong>Bagaimana proses seleksi dilakukan?</strong>
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Proses seleksi dilakukan secara otomatis dengan langkah:</p>
                            <ol>
                                <li>Input nilai akademik siswa di menu <strong>Nilai & Seleksi</strong></li>
                                <li>Tambahkan nilai prestasi jika ada</li>
                                <li>Jalankan <strong>Proses Seleksi</strong> dari menu yang sama</li>
                                <li>Sistem akan menghitung nilai total dan ranking</li>
                                <li>Tentukan siswa yang lulus berdasarkan kuota jurusan</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                            <strong>Bagaimana cara mengubah status pendaftaran?</strong>
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk mengubah status pendaftaran:</p>
                            <ol>
                                <li>Buka menu <strong>Pengaturan</strong></li>
                                <li>Pilih tab <strong>Pengaturan PPDB</strong></li>
                                <li>Ubah <strong>Status Pendaftaran</strong> menjadi "Buka" atau "Tutup"</li>
                                <li>Klik <strong>Simpan Pengaturan PPDB</strong></li>
                            </ol>
                            <p class="text-warning">Status "Tutup" akan menonaktifkan form pendaftaran publik.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                            <strong>Bagaimana cara backup database?</strong>
                        </button>
                    </h2>
                    <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk melakukan backup database:</p>
                            <ol>
                                <li>Buka menu <strong>Backup Data</strong> dari Quick Actions di Dashboard</li>
                                <li>Atau akses langsung ke <code>/admin/backup</code></li>
                                <li>Klik <strong>Buat Backup Sekarang</strong></li>
                                <li>Download file backup yang dihasilkan</li>
                            </ol>
                            <p class="text-info">Disarankan melakukan backup secara berkala sebelum update sistem.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                            <strong>Bagaimana cara export data ke Excel?</strong>
                        </button>
                    </h2>
                    <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk export data ke Excel:</p>
                            <ol>
                                <li>Buka menu <strong>Laporan</strong></li>
                                <li>Pilih opsi <strong>Export Excel</strong></li>
                                <li>Sistem akan generate file Excel yang dapat diunduh</li>
                            </ol>
                            <p>Data yang bisa di-export:</p>
                            <ul>
                                <li>Data siswa lengkap</li>
                                <li>Data nilai akademik</li>
                                <li>Hasil seleksi</li>
                                <li>Statistik pendaftaran</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                            <strong>Bagaimana mengatur kuota jurusan?</strong>
                        </button>
                    </h2>
                    <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk mengatur kuota jurusan:</p>
                            <ol>
                                <li>Buka menu <strong>Kelola Jurusan</strong></li>
                                <li>Pilih jurusan yang ingin diubah kuotanya</li>
                                <li>Klik tombol <strong>Edit</strong></li>
                                <li>Ubah nilai <strong>Kuota Penerimaan</strong></li>
                                <li>Klik <strong>Simpan Perubahan</strong></li>
                            </ol>
                            <p class="text-info">Kuota akan digunakan dalam proses seleksi otomatis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.accordion-button {
    font-weight: 600;
    background-color: #f8f9fa;
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0c63e4;
}

.accordion-body {
    background-color: #fff;
}
</style>
@endsection