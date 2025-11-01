@extends('layouts.app-tailwind')

@section('title', 'Jadwal PPDB - SMK N 2 Siatas Barita')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-primary-dark text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-white/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Jadwal PPDB
            </h1>
            <p class="text-xl text-white/90">
                Timeline penting dalam proses Penerimaan Peserta Didik Baru Tahun Ajaran 2024/2025.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Timeline -->
        <div class="max-w-4xl mx-auto">
            <!-- Timeline Item 1 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h4 class="text-primary font-semibold text-lg">Pendaftaran Online Gelombang 1</h4>
                            <p class="text-gray-500 text-sm">1 - 30 Juni 2024</p>
                        </div>
                        <span class="bg-primary text-white text-xs px-3 py-1 rounded-full font-medium">Aktif</span>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Pendaftaran dilakukan melalui website PPDB SMK N 2 Siatas Barita dengan mengisi formulir online dan mengunggah dokumen persyaratan.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 2 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Verifikasi Berkas Gelombang 1</h4>
                    <p class="text-gray-500 text-sm mb-3">1 - 5 Juli 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Verifikasi kelengkapan dan keaslian dokumen yang diunggah selama pendaftaran online gelombang 1.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 3 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Tes Seleksi Gelombang 1</h4>
                    <p class="text-gray-500 text-sm mb-3">8 Juli 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Tes tertulis dan wawancara untuk menilai kemampuan akademik dan minat calon siswa. Dilaksanakan di kampus SMK N 2 Siatas Barita.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 4 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Pengumuman Hasil Gelombang 1</h4>
                    <p class="text-gray-500 text-sm mb-3">15 Juli 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Pengumuman siswa yang diterima melalui website dan papan pengumuman sekolah. Dapat diakses mulai pukul 10.00 WIB.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 5 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Daftar Ulang Gelombang 1</h4>
                    <p class="text-gray-500 text-sm mb-3">16 - 20 Juli 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Pendaftaran ulang bagi siswa yang diterima dengan melengkapi administrasi dan menyerahkan dokumen asli untuk verifikasi.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 6 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Pendaftaran Online Gelombang 2</h4>
                    <p class="text-gray-500 text-sm mb-3">22 - 31 Juli 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Pendaftaran gelombang 2 untuk kuota yang masih tersedia. Hanya untuk jurusan yang masih memiliki kuota.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 7 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Tes Seleksi Gelombang 2</h4>
                    <p class="text-gray-500 text-sm mb-3">2 Agustus 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Tes seleksi untuk pendaftar gelombang 2. Format tes sama dengan gelombang 1.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 8 -->
            <div class="flex mb-8">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <div class="w-0.5 h-full bg-primary/30 mt-2"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Pengumuman Hasil Gelombang 2</h4>
                    <p class="text-gray-500 text-sm mb-3">5 Agustus 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Pengumuman akhir penerimaan siswa baru gelombang 2.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 9 -->
            <div class="flex">
                <div class="flex flex-col items-center mr-6">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                </div>
                <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h4 class="text-primary font-semibold text-lg mb-2">Awal Tahun Pelajaran</h4>
                    <p class="text-gray-500 text-sm mb-3">12 Agustus 2024</p>
                    <p class="text-gray-700 leading-relaxed">
                        Dimulainya tahun pelajaran baru 2024/2025 dengan kegiatan MPLS (Masa Pengenalan Lingkungan Sekolah).
                    </p>
                </div>
            </div>
        </div>

        <!-- Information Alert -->
        <div class="max-w-4xl mx-auto mt-12">
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-clock text-blue-500 text-xl mt-1 flex-shrink-0"></i>
                    <div>
                        <h5 class="font-semibold text-blue-800 mb-3">Informasi Jadwal</h5>
                        <div class="space-y-1 text-blue-700">
                            <p class="flex items-start gap-2">
                                <span>-</span>
                                <span>Semua jadwal dapat berubah sewaktu-waktu dengan pemberitahuan sebelumnya</span>
                            </p>
                            <p class="flex items-start gap-2">
                                <span>-</span>
                                <span>Pendaftar diharapkan memantau informasi terbaru melalui website ini</span>
                            </p>
                            <p class="flex items-start gap-2">
                                <span>-</span>
                                <span>Untuk informasi lebih lanjut, hubungi panitia PPDB</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection